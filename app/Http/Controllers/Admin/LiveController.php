<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Live;
use App\ForecasterPeople;
use File;

class LiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $title = 'LIVE';

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

        $live = Live::orderby('date', 'desc')->paginate(10);

        return view('admin.live',
            compact('title', 'live', 'breadcrumb')
        );
    }

    public function delete($id){
        $live = Live::find($id);
        if($live)
        {
            File::delete('upload/' . $live->image);
            if($live->delete())
                return redirect('/admin/live')->with('message', 'Успешно удалено');
        }
    }

    public function _save(Request $request, $id = 0){
            //валидация
            $this->validate($request,
                [
                    'data.title' => 'required|max:255',
                    'data.id_forecaster_people' => 'required|integer',
                    'data.date' => 'date_format:"Y-m-d H:i:s"|required',
                    'data.date_zone' => 'required|max:255',
                    'data.result' => 'required',
                    'data.type' => 'required|integer'

                ]
            );
            $data = $request->all();
            $live = $id ? Live::find($id) : (isset($data['data']) ? new Live() : null);

            $live->title = $data['data']['title'];
            $live->id_forecaster_people = $data['data']['id_forecaster_people'];
            $live->date = $data['data']['date'];
            $live->date_zone = $data['data']['date_zone'];
            $live->result = $data['data']['result'];
            $live->type = $data['data']['type'];
            $live->active = isset($data['data']['active']) ? $data['data']['active'] : 0;
            $live->save();

            return redirect('/admin/live/save/' . $live->id)->with('message', 'Успешно сохранено');

    }

    public function  save($id = 0)
    {
        $live = $id ? Live::find($id) : new Live();
        $title = $id==0 ? 'Создать' : $live->title;
        $breadcrumb = array(
            array(
                'link' => '/admin/',
                'title' => 'Главная',
            ),
            array(
                'link' => '/admin/live',
                'title' => 'LIVE',
            ),
            array(
                'link' => '',
                'title' => $title,
            )
        );

        //список предсказателей
        $forecaster_people = ForecasterPeople::IsActive()->get();

        return view('admin.live_save',
            compact('title', 'live', 'breadcrumb', 'forecaster_people')
        );
    }


}