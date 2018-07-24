<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $title = 'Оплаты';

        $breadcrumb = array(
            array(
                'link' => '/admin/',
                'title' => 'Главная',
            ),
            array(
                'link' => '',
                'title' => $title,
            )
        );

        if($request['ok'] == 'all' or !isset($request['ok'])){
            $ok = array(0, 1);
        }else if($request['ok'] >= 0){
            $ok = array($request['ok']);
        }

        $payment = Payment::with('User')->WhereIn('ok', $ok)->orderby('id', 'desc')->paginate(10);

        return view('admin.payment',
            compact('title', 'payment', 'breadcrumb', 'request')
        );
    }


}