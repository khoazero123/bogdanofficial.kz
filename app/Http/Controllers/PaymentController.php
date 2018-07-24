<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Redirect;
use Mail;
use App\User;
use App\Payment;
use App\Helpers\Helper;
use App\Helpers\PG_Signature;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $merchant_id = 505990;
    private $secret      = 'wZVcdU4C9TyYScTU';
    private $shopadmin   = array('Bagaofficial01@gmail.com');


    public function __construct()
    {

    }


    public function resultpay(Request $request)
    {

        $req = $request->all();

        // отправляем администратору письмо о том, что заказ оплачен и можно делать работу.
        $payment = Payment::where('ok', 0)->find($req['pg_order_id']);
        if(!$payment) exit();


        if($req['type'] == 'result' and $req['pg_result'] == 1)
        {

                $msg = '';

                $msg .=  "<br/> Счёт ID: " . $req['pg_order_id'];
                $msg .= "<br/> Сумма: " . $payment['sum'];
                $msg .= "<br/> Дата оплата: " . date("Y.m.d H:i:s");

                $user = User::find($payment['user_id']);

                $msg .= "<br/> ФИО: " . $user['name'];
                $msg .= "<br/> Email: " . $user['email'];
                $msg .= "<br/> Телефон: " . $user['phone'];

                $email = $this->shopadmin;
                Mail::send('mails.main', ['text' => $msg], function($m) use($email)
                {
                    $m->to($email)->subject("Пополнение счета");
                });


                $payment->result = json_encode($_REQUEST);
                $payment->ok = 1;
                $payment->save();

                return Redirect::to('/personal');


/*

        $strScriptName = PG_Signature::getOurScriptName();

        $strSecretKey = $this->secret;

        if(!PG_Signature::check($_REQUEST['pg_sig'], $strScriptName, $_REQUEST, $strSecretKey))
            $m = "Signature is not valid.";
        else
            $m = ("Ваш заказ успешно оплачен");


                $msg = json_encode($_REQUEST);
                $msg.= $m;
                $email = $this->shopadmin;

                Mail::send('mails.main', ['text' => $msg], function($m) use($email)
                {
                    $m->to($email)->subject("Пополнение счета");
                });
*/

        }
    }

    public function paymentpay(Request $request)
    {




        //валидация
        $this->validate($request,
            [
                'sum' => 'required|min:5|integer',
            ]
        );

        $req = $request->all();

        $req['sum'] = (int)$req['sum'];

        $commission = $req['sum'] * 0.029;
        $total_sum  = $req['sum'] + $commission;

        $payment = new Payment();
        $payment->user_id = Auth::id();
        $payment->sum = $req['sum'];
        $payment->commission = $commission;
        $payment->save();
        $id_order = $payment->id;

        $user = User::find(Auth::id());



        $request = [
            'pg_amount'         => $total_sum,
            'pg_check_url'      => env('APP_URL') . '/resultpay?type=check', //url for checking status of order. It must be a real url on website, and return "OK" or "rejected"
            'pg_description'    => 'desc', //any description of order
            'pg_encoding'       => 'UTF-8', //charset
            'pg_currency'       => 'KZT', //currency of payment, default is KZT
            'pg_user_ip'        => $_SERVER['REMOTE_ADDR'],
            'pg_lifetime'       => !empty($lifetime) ? $lifetime * 3600 : 86400, //lifetime of payment, default is 86400 seconds
            'pg_merchant_id'    => $this->merchant_id, //id of merchant in PayBox system
            'pg_order_id'       => $id_order, //id of order in merchant database
            'pg_result_url'     => env('APP_URL') . '/resultpay?type=result', //url to which we will send the payment result
            'pg_request_method' => 'GET', //you can use GET, POST, XML
            'pg_salt'           => rand(21, 43433), //salt that will be used in encrypting the request
            'pg_success_url'    => env('APP_URL') . '/personal', //here we will return the customer if payment was successful. It must be a real url on website
            'pg_failure_url'    => env('APP_URL') . '/resultpay?type=fail', //here we will return the customer if the payment has failed. It must be a real url on website
            'pg_user_phone'     => $user->phone, //phone of the customer, which he will see in the form of payment
            'pg_user_contact_email' => $user->email //email of the customer, where he will receive a notification of the status of payment
        ];

        $request['pg_testing_mode'] = 0; //add this parameter to request for testing payments

        //if you pass any of your parameters, which you want to get back after the payment, then add them. For example:
        $request['client_name'] = $user->name;
        //$request['client_address'] = 'Earth Planet';
        //$request['favorite color'] = 'Lime';

        //specify where to send the request, for example payment.php
        $url = 'payment.php';

        //generate a signature and add it to the array

        ksort($request);
        array_unshift($request, $url);
        array_push($request, $this->secret); //add your secret key (you can take it in your personal cabinet on paybox system)

        $request['pg_sig'] = md5(implode(';', $request));


        unset($request[0], $request[1]);

        $payment = Payment::find($id_order);
        $payment->request = json_encode($request);
        $payment->save();

        $query = http_build_query($request);


        //redirect a customer to payment page
        return Redirect::to('https://paybox.kz/' . $url . '?' . $query);
    }




}
