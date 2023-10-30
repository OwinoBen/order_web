<?php

namespace App\Http\Controllers\Front;
use App\Http\Traits\OrderTrait;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{PaymentOption, Client, ClientPreference, Order, OrderProduct, EmailTemplate, Cart, CartAddon, OrderProductPrescription, CartProduct, CartDeliveryFee, User, Product, OrderProductAddon, Payment, ClientCurrency, OrderVendor, UserAddress, Vendor, CartCoupon, CartProductPrescription, LoyaltyCard, NotificationTemplate, VendorOrderStatus,OrderTax, SubscriptionInvoicesUser, UserDevice, UserVendor, Transaction};
use App\Http\Controllers\Front\{UserSubscriptionController, OrderController, WalletController, FrontController};
use Auth, Log, Redirect ,Session;
use GuzzleHttp\Client as GCLIENT;
class SasaPayController extends Controller
{use  OrderTrait;
    // use \App\Http\Traits\BraintreePaymentManager;
    
    protected $merchant_id;
	protected $public_key;
	protected $private_key;
	public function __construct()
  	{
        // \Log::info('__construct');
		$this->sasapay_creds = PaymentOption::select('credentials')->where('code', 'sasapay')->where('status', 1)->first();
	    $this->creds_arr = json_decode($this->sasapay_creds->credentials);
	    $this->client_id = $this->creds_arr->client_id ?? '';
	    $this->client_secret = $this->creds_arr->client_secret ?? '';

	    
	}
    public function beforePayment(Request $request)
    {
    	return view('frontend.payment_gatway.sasapay');
    }

    public function authToken()
    {
        // \Log::info('authToken');

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sandbox.sasapay.app/api/v1/auth/token/?grant_type=client_credentials',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic M1FSa1I2Nzl6cWtDb3JhTnJvRnJEaks4SXB2OEhoUUtFbDF0bWtBNjpDUTNOM1Jad2htdHNPRlE1OVNZU3hIbmx5bjhTd1ZUenRuc2prUXpoZDVMM1Z0VkNDYkFNZEFLeUhON2tLUDE2Y0tJeEN4dXZlemIxdUgySkk5cXA3WlpNZUo4MERRSEk1M0ZZOXBtZHNteUxiS3NIb3FaeHVCdmFrRlo5cUEyUg=='
          ),
        ));
        
        $response = curl_exec($curl);
        $responseData = json_decode($response, true);
        // \Log::info('$responseData');
        // \Log::info($responseData['access_token']);

        curl_close($curl);
        return $responseData['access_token'];
    }

    public function createPayment(Request $request)
    {
        \Log::info('create payment sasapay');
        // \Log::info($request->all());
        $user = Auth::user();
        $phone = $user->phone_number;
        $token=$this->authToken();
        // \Log::info('token');
        // \Log::info($phone);
        // \Log::info('token');
        $postdata = [
            'MerchantCode'=> "600980",
            'NetworkCode'=> "63902",
            'PhoneNumber'=> '0742479151',
            'TransactionDesc'=> "Pay for groceries",
            'AccountReference'=> "075655550",
            'Currency'=> "KES",
            'Amount'=> $request->total_amount,
            'TransactionFee'=> 0,
            'CallBackURL'=> "https://patazone.co.ke/payment-success"

            ];            
            $client = new GCLIENT([
            'headers' => [
            'Authorization' => 'Bearer ' .$token,
            ]
            ]);
            // \Log::info('postdata');
            // \Log::info('postdata 1222222222');

            // \Log::info('Bearer '.$token);
            \Log::info('postdata');
            $res = $client->post('https://sandbox.sasapay.app/api/v1/payments/request-payment/', [
            'form_params' => ($postdata)
            ]);
            $response = json_decode($res->getBody(), true);

            
        // \Log::info($response);

	    if($response['status']===true)
	    {
        \Log::info('success ');

	        $returnUrl = $this->sucessPayment($request,$response,$postdata);
	    }
	    else {
        // \Log::info('fail saasaa');

	        $returnUrl = $this->failedPayment($request);
	    }
    	
        return Redirect::to(url($returnUrl));
    }
    public function sucessPayment($request,$response,$postdata)
    {
        \Log::info('success sucessPayment function');
        \Log::info($postdata);
        \Log::info('success sucessPayment232saasaa');

        $user = Auth::user();
    	if($request->payment_from == 'cart'){
                \Log::info('Payment =');

                    $data = [
                        'amount' => $request->total_amount,
                        'payment_option_id' => '60',
                        'transaction_id' => $response['CheckoutRequestID'],
                        'balance_transaction' => $postdata['Amount'],
                        'viva_order_id' => $request->order_number ?? '',
                        'user_id' => $user->id,
                        'date' => date('Y-m-d'),
                        'type' => 'cart',
        
                    ];
                
                Payment::create($data);
                // \Log::info($data);
                 
        } elseif($request->payment_from == 'wallet'){
            // \Log::info('wallet sasapay');
            // \Log::info($request->all());
            // \Log::info($request->payment_from );

            $request->request->add(['wallet_amount' => $request->amount, 'transaction_id' => $response['CheckoutRequestID']]);

            $data = [
                'amount' => $request->total_amount,
                'payment_option_id' => '60',
                'transaction_id' => $response['CheckoutRequestID'],
                'balance_transaction' => $request->total_amount,
                'viva_order_id' => $request->order_number ?? '',
                'user_id' => $user->id,
                'date' => date('Y-m-d'),
                'balance_transaction' => $postdata['Amount'],
                'type' => 'wallet_topup',
            ];
        
        Payment::create($data);
        // \Log::info('wallet sasapay sad');

        }
        elseif($request->payment_from == 'tip'){
            $request->request->add(['order_number' => $request->order_number, 'tip_amount' => $request->amount, 'transaction_id' => $request->tranRef]);
            $orderController = new OrderController();
            $orderController->tipAfterOrder($request);
            if($request->come_from == 'app')
            {
                $returnUrl = route('payment.gateway.return.response').'/?gateway=paytab'.'&status=200&transaction_id='.$request->tranRef;
            }else{
                $returnUrl = route('user.orders');
            }
            return $returnUrl;
        }
        elseif($request->payment_from == 'subscription'){               
            $request->request->add(['payment_option_id' => 27, 'transaction_id' => $request->tranRef]);
            $subscriptionController = new UserSubscriptionController();
            $subscriptionController->purchaseSubscriptionPlan($request, '', $request->subscription_id);
            if($request->come_from == 'app')
            {
                $returnUrl = route('payment.gateway.return.response').'/?gateway=paytab'.'&status=200&transaction_id='.$request->tranRef;
            }else{
                $returnUrl = route('user.subscription.plans');
            }
            return $returnUrl;
        }
        return Redirect::to(route('order.return.success'));
    }
    public function failedPayment($request)
    {
    	if($request->payment_from == 'cart'){
            $order_number = $request->order_number;
            $order = Order::with(['paymentOption', 'user_vendor', 'vendors:id,order_id,vendor_id'])->where('order_number', $order_number)->first();
            $order_products = OrderProduct::select('id')->where('order_id', $order->id)->get();
            foreach ($order_products as $order_prod) {
                OrderProductAddon::where('order_product_id', $order_prod->id)->delete();
            }
            OrderProduct::where('order_id', $order->id)->delete();
            OrderProductPrescription::where('order_id', $order->id)->delete();
            VendorOrderStatus::where('order_id', $order->id)->delete();
            OrderVendor::where('order_id', $order->id)->delete();
            OrderTax::where('order_id', $order->id)->delete();
            Order::where('id', $order->id)->delete();
            if($request->come_from == 'app')
            {
                $returnUrl = route('payment.gateway.return.response').'/?gateway=paytab&status=0';
            }else{
                $returnUrl = route('showCart');
            }
            return $returnUrl;
        }
        elseif($request->payment_from == 'wallet_topup'){
            if($request->come_from == 'app')
            {
                $returnUrl = route('payment.gateway.return.response').'/?gateway=paytab&status=0';
            }else{
                $returnUrl = route('user.wallet');
            }
            return $returnUrl;
        }
        elseif($request->payment_from == 'tip'){
            if($request->come_from == 'app')
            {
                $returnUrl = route('payment.gateway.return.response').'/?gateway=paytab&status=0';
            }else{
                $returnUrl = route('user.orders');
            }
            return $returnUrl;
        }
        elseif($request->payment_from == 'subscription'){
            if($request->come_from == 'app')
            {
                $returnUrl = route('payment.gateway.return.response').'/?gateway=paytab&status=0';
            }else{
                $returnUrl = route('user.subscription.plans');
            }
            return $returnUrl;
        }
        return route('order.return.success');
    }

    public function createOrder($request){
        \Log::info('createOrder');
        \Log::info($request->all());
        return 'hi';
    }
    public function success(Request $request){

        $json = json_decode($request->getContent());


        // $request->id ? Auth::loginUsingId($request->id) : '';
            $payment = Payment::where('transaction_id', $json->CheckoutRequestID)->first();
            \Log::info('wallet suc pay 2323');
            \Log::info('$payment'); 
            \Log::info($payment); 
            \Log::info('$request12'); 

            \Log::info($request); 
            \Log::info('$request23');  

               
            if ($payment->type == 'cart') {
                 $this->completeOrderCart($json, $payment);
            } elseif ($payment->type == 'wallet_topup') {
            \Log::info('wallet sasapay 2sdsd3');
            $this->completeOrderWallet($json, $payment);
            }
            
        return response([],200);
    }
    
    public function completeOrderCart(Request $request, $payment)
    {
        $order = Order::where('order_number', $payment->viva_order_id)->first();
        \Log::info('cartts suc pay');
        \Log::info('$order'); 
        \Log::info($payment); 

        \Log::info($request); 
    
        if (! empty($order)) {
            $order->payment_status = '1';
            $order->save();
    
            $this->orderSuccessCartDetail($order);
            
            if(isset($request->come_from) && $request->come_from == 'app')
            {
                $response['status']         = 200;
                $response['msg']            = 'Success Added wallet.';
                $response['payment_from']   = 'wallet_topup';
                $response['order_id']       = $order->id;
                return response()->json($response);
            }
            return redirect()->route('order.success',['order_id' => $order->id]);
    
        } else {
            $user = auth()->user();
            $wallet = $user->wallet;
            if (isset($order->wallet_amount_used)) {
                $wallet->depositFloat($order->wallet_amount_used, [
                    'Wallet has been <b>refunded</b> for cancellation of order #' . $order->order_number
                ]);
            }
    
            if(isset($request->come_from) && $request->come_from == 'app')
            {
                $response['status']         = 200;
                $response['msg']            = 'Success Added wallet.';
                $response['payment_from']   = 'Wallet has been <b>refunded</b> for cancellation of order #' . $order->order_number;
                return response()->json($response);
            }
    
            return redirect()->route('user.wallet');
        }
    }
    
    public function completeOrderWallet($request,$payment)
    {
        \Log::info('wallet completeOrderWallet');
        \Log::info($payment); 
        \Log::info('wallet completeOrderWallet payment');

        // \Log::info($request); 
        $data['amount'] =  $payment->amount;
        $data['transaction_id'] =  $payment->transaction_id;
        $data['payment_option_id'] =  '60';
        // $data['come_from'] = $request['come_from'];
        $data['user_id'] =  $payment->user_id;
        \Log::info('wallet completeOrderWallet 222');
        \Log::info($data);    
        $request = new \Illuminate\Http\Request($data);
        $this->creditMyWallet($request);
        // if(isset($request->come_from) && $request->come_from == 'app')
        // {
        //     $response['status']         = 200;
        //     $response['msg']            = 'Success Added wallet.';
        //     $response['payment_from']   = 'wallet_topup';
        //     return response()->json($response);
        // }
        \Log::info('return to  user wallet');    
        return redirect()->route('user.wallet');
    
    }
    
    public function creditMyWallet(Request $request, $domain = '')
    {
        if( (isset($request->user_id)) && (!empty($request->user_id)) ){
            $user = User::find($request->user_id);
        }elseif( (isset($request->auth_token)) && (!empty($request->auth_token)) ){
            $user = User::whereHas('device',function  ($qu) use ($request){
                $qu->where('access_token', $request->auth_token);
            })->first();
    
        }else{
        $user = Auth::user();
        }
        if($user){
        \Log::info('creditMyWallet');  
        \Log::info($user);    
            $credit_amount = $request->amount;
            $wallet = $user->wallet;
            if ($credit_amount > 0) {
        \Log::info($credit_amount);    
                $saved_transaction = Transaction::where('meta', 'like', '%'.$request->transaction_id.'%')->first();
                if($saved_transaction){
        \Log::info('$saved_transaction'); 
        \Log::info($saved_transaction);    

                    // return $this->errorResponse('Transaction has already been done', 400);
                }
    
                $wallet->depositFloat($credit_amount, [__("Wallet has been").' <b>Credited</b> by transaction reference <b>'.$request->transaction_id.'</b>']);
    
                $payment = new Payment();
                $payment->date = date('Y-m-d');
                $payment->user_id = $user->id;
                $payment->transaction_id = $request->transaction_id;
                $payment->payment_option_id = $request->payment_option_id ?? null;
                $payment->balance_transaction = $credit_amount;
                $payment->type = 'wallet';
                $payment->save();
    
                $transactions = Transaction::where('payable_id', $user->id)->get();
                $response['wallet_balance'] = $wallet->balanceFloat;
                $response['transactions'] = $transactions;
                $message = 'Wallet has been credited successfully';
                Session::put('success', $message);
                \Log::info('$message'); 
                \Log::info($message); 
                return $this->successResponse($response, $message, 200);
            }
            else{
                // return $this->errorResponse('Amount is not sufficient', 400);
            }
        }
        else{
            // return $this->errorResponse('Invalid User', 400);
        }
    }
}

