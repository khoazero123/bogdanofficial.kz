<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Helpers;
use App\UserRole;
use App\Payment;
use Illuminate\Validation\Rule;
use Auth;
use App\Subscription;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function delete($user_id){
        if(Auth::id() != $user_id)
        {
            $user = User::find($user_id);
            if($user)
            {
                UserRole::where('user_id', $user->id)->delete();
                if($user->delete())
                    return redirect('/admin/user')->with('message', 'Успешно удалено');
            }
        }
    }

    public function index()
    {
        $title = 'Список пользователей';
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
        $users = User::OrderBy('id', 'DESC')->paginate(10);
        return view('admin.user',
            compact('title', 'users', 'breadcrumb')
        );
    }


    public function _save(Request $request, $user_id = 0){
        //валидация

        $validate = [
            'name' => 'required|string|max:255',
            'email' => ['required','string','email','max:255',
                Rule::unique('users')->where(function ($query) use ($user_id) {
                    return $query->where('id','<>', $user_id);
                })
            ],
            'phone' => ['required','string','max:255',
                Rule::unique('users')->where(function ($query) use ($user_id) {
                    return $query->where('id','<>', $user_id);
                })
            ],
        ];
        if($user_id == 0)
            $validate['password'] = 'required|string|min:6|confirmed';

        $this->validate($request,$validate);

        $data = $request->all();

        $user = $user_id ? User::find($user_id) : new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        if(!empty($data['password']))
            $user->password = bcrypt($data['password']);
        $user->save();

        $user_role = ($user_id > 0) ? UserRole::where('user_id', $user_id)->first() : new UserRole();
        $user_role->role_id = $data['role_id'];
        $user_role->user_id = $user->id;
        $user_role->save();

        return redirect('/admin/user/save/' . $user->id)->with('message', 'Успешно сохранено');
    }

    public function  save($user_id = 0)
    {
        $user = $user_id ? User::find($user_id) : null;
        $user_role = $user_id ? UserRole::where('user_id', $user_id)->first() : null;
        $roles = Role::all();

        $payment = $user_id ? Payment::where('user_id', $user_id)->get() : array();

        $subscription = $user_id ? Subscription::where('user_id', $user_id)->with('SubscriptionType')->get() : array();

        $title = $user_id==0 ? 'Создать' : $user->name;
        $breadcrumb = array(
            array(
                'link' => '/admin/',
                'title' => 'Главная',
            ),
            array(
                'link' => '/admin/user',
                'title' => 'Список пользователей',
            ),
            array(
                'link' => '',
                'title' => $title,
            )
        );

        return view('admin.user_save',
            compact('title', 'live', 'breadcrumb', 'roles', 'user', 'user_role', 'payment', 'subscription')
        );
    }



}