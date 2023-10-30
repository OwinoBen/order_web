<?php
namespace App\Http\Traits;

trait PaymentTrait{

    function paymentOptionArray($type='')
    {
        if($type=='cart')
        {
            $paymentOptions = ['cod','azul', 'paypal', 'paystack', 'payfast', 'stripe', 'stripe_fpx', 'mobbex','yoco','paylink','razorpay','gcash','simplify','square','pagarme','checkout','authorize_net','kongapay','ccavenue', 'cashfree','toyyibpay','easebuzz','vnpay','paytab','flutterwave','mvodafone','windcave','payphone','offline_manual','stripe_oxxo','stripe_ideal','viva_wallet', 'mycash','dpo','openpay','userede','upay','conekta','telr','khalti','plugnpay','nmi','yappy','skip_cash','data_trans','mtn_momo','pesapal','sasapay'];

        }elseif($type=='Subscription')
        {
            $paymentOptions = ['stripe', 'dpo','azul', 'stripe_fpx', 'paystack','yoco', 'paylink', 'razorpay','simplify','square','ozow','pagarme', 'checkout','authorize_net','kongapay','ccavenue', 'cashfree','viva_wallet','easebuzz','vnpay','paytab','mvodafone','flutterwave','easypaisa','braintree','payphone','windcave','paytech','windcave','stripe_oxxo', 'mycash','stripe_ideal','userede','openpay','khalti','mtn_momo','plugnpay','nmi','yappy','skip_cash','data_trans','pesapal','powertrans','obo','sasapay'];

        }elseif($type=='wallet')
        {
            $paymentOptions = ['paypal','azul', 'paystack', 'payfast', 'stripe', 'stripe_fpx', 'yoco', 'paylink','razorpay','simplify','square','pagarme','checkout','authorize_net','kongapay','ccavenue', 'cashfree','toyyibpay','easebuzz','vnpay','paytab','flutterwave','mvodafone','windcave','payphone','stripe_oxxo','stripe_ideal','viva_wallet', 'mycash', 'dpo','openpay','userede','upay','conekta','telr','khalti','plugnpay','nmi','yappy','skip_cash','data_trans','mtn_momo','pesapal','sasapay'];

        }elseif($type=='pickup_delivery')
        {
            $paymentOptions = ['cod','azul', 'dpo', 'razorpay','paystack','stripe','payfast','offline_manual','authorize_net','payphone','khalti','flutterwave','plugnpay','nmi','yappy','skip_cash','ccavenue','data_trans','mtn_momo','pesapal','sasapay'];

        }elseif($type=='tip')
        {
            $paymentOptions = ['data_trans','mtn_momo','pesapal'];

        }elseif($type=='payout')
        {
            //Vendor Payouts
            $paymentOptions = ['cash','stripe','pagarme','razorpay'];

        }elseif($type=='homepage')
        {
            //HomePageController
            $paymentOptions = ['stripe', 'stripe_fpx', 'stripe_oxxo','stripe_ideal','razorpay', 'checkout', 'paytab','flutterwave', 'khalti','skip_cash'];

        }elseif('payment_codes'){
            //payment_codes paymentOptionController page
            $paymentOptions = ['cod','azul', 'dpo', 'wallet', 'layalty-points', 'paypal', 'stripe', 'stripe_fpx', 'paystack', 'payfast', 'mobbex', 'yoco', 'paylink', 'razorpay','gcash','simplify','square','ozow','pagarme','checkout','authorize_net','kongapay','ccavenue','easypaisa', 'cashfree','viva_wallet','easebuzz','toyyibpay','paytab','vnpay','mvodafone','flutterwave','payphone','braintree','windcave','paytech','stripe_oxxo','offline_manual', 'mycash','stripe_ideal','userede','openpay','upay','conekta','telr','khalti','mtn_momo','plugnpay','payway','skip_cash','nmi','yappy','skip_cash','data_trans','pesapal','powertrans','obo','sasapay'];
        }else{
            $paymentOptions = ['cod','azul', 'paypal', 'paystack', 'payfast', 'stripe', 'stripe_fpx', 'mobbex','yoco','paylink','razorpay','gcash','simplify','square','pagarme','checkout','authorize_net','kongapay','ccavenue', 'cashfree','toyyibpay','easebuzz','vnpay','paytab','flutterwave','mvodafone','windcave','payphone','offline_manual','stripe_oxxo','stripe_ideal','viva_wallet', 'mycash','dpo','openpay','userede','upay','conekta','telr','khalti','plugnpay','nmi','yappy','skip_cash','pesapal','powertrans'];
        }


        return $paymentOptions;

    }

}
