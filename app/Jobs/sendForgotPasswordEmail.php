<?php

namespace App\Jobs;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Bus\Queueable;
use App\Mail\ForgotPasswordMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\{Client, ClientPreference};
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class sendForgotPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $client = Client::select('id', 'name', 'email', 'phone_number', 'logo')->first();
        $data = ClientPreference::select('mail_type', 'mail_driver', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from')->first();
        if (!empty($data->mail_driver) && !empty($data->mail_host) && !empty($data->mail_port) && !empty($data->mail_password) && !empty($data->mail_encryption)) {
            $confirured = $this->setMailDetail($data->mail_driver, $data->mail_host, $data->mail_port, $data->mail_username, $data->mail_password, $data->mail_encryption);
            $details['client_name'] = $client->name;
            $this->details = $details;
            $this->client_name = $client->name;
            $this->mail_from = $data->mail_from;
            $this->client_logo = $client->logo['original'];
        }
    }
    // /**
    //  * Execute the job.
    //  *
    //  * @return void
    //  */
    public function handle()
    {
        $email = new ForgotPasswordMail($this->details);
        Mail::to($this->details['email'])->send($email);
    }

    public function setMailDetail($mail_driver, $mail_host, $mail_port, $mail_username, $mail_password, $mail_encryption)
    {
        $config = array(
            'pretend' => false,
            'host' => $mail_host,
            'port' => $mail_port,
            'driver' => $mail_driver,
            'username' => $mail_username,
            'password' =>$mail_password,
            'encryption' => $mail_encryption,
            'sendmail' => '/usr/sbin/sendmail -bs',
        );
        Config::set('mail', $config);
        $app = App::getInstance();
        $app->register('Illuminate\Mail\MailServiceProvider');
        return true;
    }
}
