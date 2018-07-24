<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SubscriptionType;
use Illuminate\Validation\Rule;

class SubscriptionTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $title = 'Тарифы';

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

        $subscription_type = SubscriptionType::all();

        return view('admin.subscription_type',
            compact('title', 'subscription_type', 'breadcrumb')
        );
    }

    public function _save(Request $request, $id = 0){
        //валидация
        $this->validate($request,
            [
                'data.title'  => 'required|max:255',
                'data.day'    => 'required|integer',
                'data.price'  => 'required|integer',
                'data.active' => 'integer'
            ],
            [],
            [
                'data.title'  => 'Название',
                'data.day'    => 'Количество дней',
                'data.price'  => 'Цена',
                'data.active' => 'Активность'
            ]
        );
        $data = $request->all();

        $subscription_type = $id ? SubscriptionType::find($id) : (isset($data['data']) ? new SubscriptionType() : null);
        $subscription_type->title   = $data['data']['title'];
        $subscription_type->day     = $data['data']['day'];
        $subscription_type->price   = $data['data']['price'];
        $subscription_type->active  = isset($data['data']['active']) ? $data['data']['active'] : 0;
        $subscription_type->save();

        return redirect('/admin/subscription-type/save/' . $subscription_type->id)->with('message', 'Успешно сохранено');

    }

    public function  save($id = 0)
    {
        $subscription_type = $id ? SubscriptionType::find($id) : new SubscriptionType();
        $title = $id==0 ? 'Создать' : $subscription_type->title;
        $breadcrumb = array(
            array(
                'link' => '/admin/',
                'title' => 'Главная',
            ),
            array(
                'link' => '/admin/subscription-type',
                'title' => 'Тарифы',
            ),
            array(
                'link' => '',
                'title' => $title,
            )
        );


        return view('admin.subscription_type_save',
            compact('title', 'subscription_type', 'breadcrumb')
        );
    }


}