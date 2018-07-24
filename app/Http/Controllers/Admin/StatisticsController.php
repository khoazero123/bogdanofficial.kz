<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Statistics;
use App\ForecasterPeople;
use File;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $title = 'Статистика';

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

    $statistics = Statistics::orderby('id', 'desc')->paginate(10);

        return view('admin.statistics',
            compact('title', 'statistics', 'breadcrumb')
        );
    }

    public function delete($id){
        $statistics = Statistics::find($id);
        if($statistics)
        {
            File::delete('upload/' . $statistics->image);
            if($statistics->delete())
                return redirect('/admin/statistics')->with('message', 'Успешно удалено');
        }
    }

    public function _save(Request $request, $id = 0){
            //валидация
            $this->validate($request,
                [
                    'data.title' => 'required|max:255',
                    'data.date' => 'date_format:"Y-m-d H:i:s"|required',
                    'data.id_forecaster_people' => 'required|integer',
                ]
            );
            $data = $request->all();
            $statistics = $id ? Statistics::find($id) : (isset($data['data']) ? new Statistics() : null);
            $statistics->title = $data['data']['title'];
            $statistics->date = $data['data']['date'];

            //фото
            if(isset($data['data']['image'])){
                $new_logo = time() . rand() . $data['data']['image']->getClientOriginalName();
                if($data['data']['image']->move('upload/', $new_logo)){
                    //удаляем старый логотип
                    if(!empty($statistics->logo) and isset($data['data']['id']))
                        File::delete('upload/' . $statistics->image);
                    $statistics->image = $new_logo;
                }
            }


            $statistics->id_forecaster_people = $data['data']['id_forecaster_people'];
            $statistics->active = isset($data['data']['active']) ? $data['data']['active'] : 0;
            $statistics->save();
            return redirect('/admin/statistics/save/' . $statistics->id)->with('message', 'Успешно сохранено');

    }

    public function  save($id = 0)
    {
        $statistics = $id ? Statistics::find($id) : new Statistics();
        $title = $id==0 ? 'Создать' : $statistics->title;
        $breadcrumb = array(
            array(
                'link' => '/admin/',
                'title' => 'Главная',
            ),
            array(
                'link' => '/admin/statistics',
                'title' => 'Статистика',
            ),
            array(
                'link' => '',
                'title' => $title,
            )
        );

        //список предсказателей
        $forecaster_people = ForecasterPeople::IsActive()->get();

        return view('admin.statistics_save',
            compact('title', 'statistics', 'breadcrumb', 'forecaster_people')
        );
    }


}