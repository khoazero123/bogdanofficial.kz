<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\SubscriptionType;
use App\Payment;
use App\User;
use Auth;
use Validator;
use App\Subscription;
use Illuminate\Validation\Rule;
use Redirect;
use DB;
use Mail;

class PersonalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //подписка
        $subscription_sum = Subscription::where('user_id', Auth::id())->sum('price');
        //пополнил счет
        $payment_sum      = Payment::where('user_id', Auth::id())->where('ok', 1)->sum('sum');

        $account = $payment_sum - $subscription_sum;

        //Осталось дней
        $days_left = Subscription::where('user_id', Auth::id())
                                 ->where(DB::raw('DATE_ADD(start_date, INTERVAL day DAY)'), '>=', date("Y.m.d H:i:s"))
                                 ->sum('day');

        $max_end_date = Subscription::where('user_id', Auth::id())->max(DB::raw('DATE_ADD(start_date, INTERVAL day DAY)'));



        $title = 'Личный кабинет';
        return view('personal.index',
            compact('title', 'account', 'days_left', 'max_end_date')
        );
    }

    public function subscription()
    {
        //приверка бесплатных
        $free = SubscriptionType::
            join('subscription as s', function($join)
            {
                $join->on('s.subscription_type_id', 'subscription_type.id');
                $join->where('s.user_id', Auth::id());
            })->where('subscription_type.price', 0)->pluck('subscription_type.id')->toArray();

        $subscription_type = SubscriptionType::where('active', 1)->whereNotIn('id', $free)->get();

        $title = 'Покупка подписки';
        return view('personal.subscription',
            compact('title', 'subscription_type', 'free')
        );
    }

    public function subscription_request(Request $request)
    {

        $validate = [
            'subscription'   =>
                [
                    'required',
                    'integer',
                    Rule::exists('subscription_type', 'id')->where(function ($query){
                        $query->where('active', 1);
                    })
                ]
        ];
        $names = [
            'subscription'   => "'Тип подписки'"
        ];

        $req = $request->all();




        //валидация
        $validation = Validator::make($request->all(), $validate, [], $names);
        if($validation->passes())
        {
            //приверка бесплатных
            $free = SubscriptionType::join('subscription as s', function($join)
                                        {
                                            $join->on('s.subscription_type_id', 'subscription_type.id');
                                            $join->where('s.user_id', Auth::id());
                                        })->where('subscription_type.price', 0)->pluck('subscription_type.id')->toArray();

            if(in_array($req['subscription'] ,$free)){
                $validation->getMessageBag()->add('subscription', "Ошибка");
                return Redirect::back()->withErrors($validation)->withInput();
            }


            $subscription_type = SubscriptionType::find($req['subscription']);
            //подписка
            $subscription_sum = Subscription::where('user_id', Auth::id())->sum('price');
            //пополнил счет
            $payment_sum      = Payment::where('user_id', Auth::id())->where('ok', 1)->sum('sum');


            if(($payment_sum - $subscription_sum) >= $subscription_type->price)
            {

                    //текуший
                    $current_subscription = Subscription::where('user_id', Auth::id())
                        ->where(function($query) {
                            $query->where(function($query) {
                                $query->where('start_date', '<=', date("Y.m.d H:i:s"))
                                    ->where(DB::raw('DATE_ADD(start_date, INTERVAL day DAY)'), '>=', date("Y.m.d H:i:s"));
                            });
                            $query->orWhere(DB::raw('DATE_ADD(start_date, INTERVAL day DAY)'), '>', date("Y.m.d H:i:s"));
                        })
                        ->select(DB::raw('DATE_ADD(start_date, INTERVAL day DAY) as end_date'))
                        ->OrderBy('id', 'DESC')
                        ->first();


                    $subscription = new Subscription();
                    $subscription->user_id = Auth::id();
                    $subscription->subscription_type_id = $req['subscription'];
                    $subscription->price = $subscription_type['price'];
                    $subscription->day = $subscription_type['day'];
                    $subscription->start_date = $current_subscription ? $current_subscription->end_date : date("Y.m.d H:i:s");
                    $subscription->save();


                    $email = array('Bagaofficial01@gmail.com');

                    $msg =  '<br/>Тариф: ' . $subscription_type->title;
                    $msg .= '<br/>Цена: ' . $subscription_type->price;
                    $msg .= '<br/>Количество дней: ' . $subscription_type->day;

                    $max_end_date = Subscription::where('user_id', Auth::id())->max(DB::raw('DATE_ADD(start_date, INTERVAL day DAY)'));
                    $msg .= '<br/>Подписано до(итого): ' . $max_end_date;

                    $user = User::find(Auth::id());
                    $msg .= "<br/> ФИО: " . $user['name'];
                    $msg .= "<br/> Email: " . $user['email'];
                    $msg .= "<br/> Телефон: " . $user['phone'];

                    Mail::send('mails.main', ['text' => $msg], function($m) use($email)
                    {
                        $m->to($email)->subject("Новая подписка");
                    });

            }else{
                $validation->getMessageBag()->add('privacy', "Пополните счет");
                return Redirect::back()->withErrors($validation)->withInput();
            }
        }else{
            return Redirect::back()->withErrors($validation)->withInput();
        }



        return Redirect::back()->with('message', 'Успешная подписка');

    }



    public function payment()
    {
        $title = 'Пополнить счёт';
        return view('personal.payment',
            compact('title')
        );
    }


    public function data()
    {
        $current_user = User::find(Auth::id());
        $title = 'Личные данные';
        return view('personal.data',
            compact('title', 'current_user')
        );
    }
    public function data_request(Request $request)
    {
        $validate = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'required|string|max:255|unique:users,phone,' . Auth::id(),
            'password' => 'nullable|string|min:6|confirmed',
        ];

        $names = [
            'name' => "'ФИО'",
            'email' => "'Email'",
            'phone' => "'Телефон'",
            'password' => "'Новый пароль'",
        ];

        //валидация
        $validation = Validator::make($request->all(), $validate, [], $names);
        if($validation->passes())
        {
            $req = $request->all();
            $current_user = User::find(Auth::id());
            $current_user->name = $req['name'];
            $current_user->email = $req['email'];
            $current_user->phone = $req['phone'];

            if(!empty($req['password']))
                $current_user->password = bcrypt($req['password']);

            $current_user->save();
            return Redirect::back()->with('message', 'Успешно изменено');
        }else{
            return Redirect::back()->withErrors($validation)->withInput();
        }
    }






}
