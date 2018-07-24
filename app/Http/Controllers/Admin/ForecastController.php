<?php
namespace App\Http\Controllers\Admin;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Forecast;
use App\ForecasterPeople;
use File;
use Illuminate\Validation\Rule;

class ForecastController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $title = 'Прогнозы';

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

    $forecast = Forecast::orderby('date', 'desc')->paginate(10);

        return view('admin.forecast',
            compact('title', 'forecast', 'breadcrumb')
        );
    }

    public function delete($id){
        $forecast = Forecast::find($id);
        if($forecast)
        {
            File::delete('upload/' . $forecast->image);
            if($forecast->delete())
                return redirect('/admin/forecast')->with('message', 'Успешно удалено');
        }
    }

    public function _save(Request $request, $id = 0){
            //валидация
            $this->validate($request,
                [
                    'title' => 'required|max:255',
                    'code' => ['required','max:255',
                        Rule::unique('forecast')->where(function ($query) use ($id) {
                            return $query->where('id','<>', $id);
                        })
                    ],
                    'date' => 'date_format:"Y-m-d H:i:s"|required',
                    'id_forecaster_people' => 'required|integer',
                    'description' => 'required',
                    'result' => 'required'
                ]
            );
            $data = $request->all();
            $forecast = $id ? Forecast::find($id) : (isset($data['title']) ? new Forecast() : null);
            $forecast->title = $data['title'];
            $forecast->code = Helper::generate_chpu($data['code']);
            $forecast->date = $data['date'];


            //фото
            if(isset($data['image'])){
                $new_logo = time() . rand() . $data['image']->getClientOriginalName();
                if($data['image']->move('upload/', $new_logo)){
                    //удаляем старый логотип
                    if(!empty($forecast->logo) and isset($data['id']))
                        File::delete('upload/' . $forecast->image);
                    $forecast->image = $new_logo;
                }
            }

            $forecast->description = $data['description'];
            $forecast->result = $data['result'];
            $forecast->id_forecaster_people = $data['id_forecaster_people'];
            $forecast->active = isset($data['active']) ? $data['active'] : 0;
            $forecast->save();
            return redirect('/admin/forecast/save/' . $forecast->id)->with('message', 'Успешно сохранено');

    }

    public function  save($id = 0)
    {
        $forecast = $id ? Forecast::find($id) : new Forecast();
        $title = $id==0 ? 'Создать' : $forecast->title;
        $breadcrumb = array(
            array(
                'link' => '/admin/',
                'title' => 'Главная',
            ),
            array(
                'link' => '/admin/forecast',
                'title' => 'Прогнозы',
            ),
            array(
                'link' => '',
                'title' => $title,
            )
        );

        //список предсказателей
        $forecaster_people = ForecasterPeople::IsActive()->get();

        return view('admin.forecast_save',
            compact('title', 'forecast', 'breadcrumb', 'forecaster_people')
        );
    }


}