<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ForecasterPeople;
use App\Helpers\Helper;
use File;
use Illuminate\Validation\Rule;

class ForecasterPeopleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $title = 'Прогнозисты';

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

        $forecaster_people = ForecasterPeople::orderby('id', 'desc')->paginate(10);

        return view('admin.forecaster_people',
            compact('title', 'forecaster_people', 'breadcrumb')
        );
    }

    public function delete($id){
        $forecaster_people = ForecasterPeople::find($id);
        if($forecaster_people)
        {
            File::delete('upload/' . $forecaster_people->image);
            if($forecaster_people->delete())
                return redirect('/admin/forecaster-people')->with('message', 'Успешно удалено');
        }
    }

    public function _save(Request $request, $id = 0){
            //валидация
            $this->validate($request,
                [
                    'fullname' => 'required|max:255',
                    'code' => ['required','max:255',
                        Rule::unique('forecaster_people')->where(function ($query) use ($id) {
                            return $query->where('id','<>', $id);
                        })
                    ],
                    'description' => 'required',
                ]
            );
            $data = $request->all();
            $forecaster_people = $id ? ForecasterPeople::find($id) : (isset($data['fullname']) ? new ForecasterPeople() : null);
            $forecaster_people->fullname = $data['fullname'];
            $forecaster_people->code = Helper::generate_chpu($data['code']);
            $forecaster_people->description = $data['description'];
            $forecaster_people->active = isset($data['active']) ? $data['active'] : 0;

            //фото
            if(isset($data['image'])){
                $new_logo = time() . rand() . $data['image']->getClientOriginalName();
                if($data['image']->move('upload/', $new_logo)){
                    //удаляем старый логотип
                    if(!empty($forecaster_people->logo) and isset($data['id']))
                        File::delete('upload/' . $forecaster_people->image);
                    $forecaster_people->image = $new_logo;
                }
            }

            $forecaster_people->save();
            return redirect('/admin/forecaster-people/save/' . $forecaster_people->id)->with('message', 'Успешно сохранено');

    }

    public function  save($id = 0)
    {
        $forecaster_people = $id ? ForecasterPeople::find($id) : new ForecasterPeople();
        $title = $id==0 ? 'Создать' : $forecaster_people->title;
        $breadcrumb = array(
            array(
                'link' => '/admin/',
                'title' => 'Главная',
            ),
            array(
                'link' => '/admin/forecaster-people',
                'title' => 'Прогнозисты',
            ),
            array(
                'link' => '',
                'title' => $title,
            )
        );

        return view('admin.forecaster_people_save',
            compact('title', 'forecaster_people', 'breadcrumb')
        );
    }


}