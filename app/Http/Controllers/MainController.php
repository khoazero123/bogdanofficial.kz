<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Forecast;
use App\ForecasterPeople;
use App\Statistics;
use App\Blog;
use App\Faq;
use App\Live;
use App\Subscription;
use Auth;
use DB;








class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::IsActive()->orderby('id', 'desc')->limit(4)->get();

        return view('index',
            compact('blog')
        );
    }

    //списко Прогнозы
    public function forecast($code_forecaster_people = '')
    {
        $code_forecaster_people = strtolower(trim($code_forecaster_people));

        //список предсказателей
        $forecasterPeople = ForecasterPeople::IsActive()->get();

        //Прогнозы
        if(empty($code_forecaster_people)){
            $forecast = Forecast::IsActive()->orderBy('date', 'desc')->paginate(8);
        }else{

            $id_forecaster_people = 0;
            foreach($forecasterPeople as $fp_item)
                if($fp_item->code == $code_forecaster_people)
                    $id_forecaster_people = $fp_item->id;

            $forecast = Forecast::IsActive()->where('id_forecaster_people', $id_forecaster_people)->orderBy('date', 'desc')->paginate(8);
        }

        $title = 'Прогнозы';
        return view('forecast',
            compact('title', 'forecast', 'forecasterPeople', 'code_forecaster_people')
        );
    }

    //детально Прогнозы
    public function forecast_detail($code_forecaster_people, $forecast_code){

        $forecast_code = strtolower(trim($forecast_code));

        $forecast = Forecast::IsActive()->where('code', $forecast_code)->first();

        //Осталось дней
        $days_left = Subscription::where('user_id', Auth::id())
            ->where(DB::raw('DATE_ADD(start_date, INTERVAL day DAY)'), '>=', date("Y.m.d H:i:s"))
            ->sum('day');

        $title = $forecast->title;
        return view('forecast_detail',
            compact('title', 'forecast', 'days_left')
        );
    }

    //Статистика
    public function statistics(){
        $title = 'Статистика';

        $statistics = Statistics::IsActive()->orderBy('date', 'desc')->paginate(4);

        return view('statistics',
            compact('title', 'statistics')
        );
    }

    //Статистика
    public function forecaster_people(){
        $title = 'Команда прогнозистов';

        //список предсказателей
        $forecaster_people = ForecasterPeople::IsActive()->get();

        return view('forecaster_people',
            compact('title', 'forecaster_people')
        );
    }

    //блок
    public function blog(){
        $title = 'Блог';
        $blog = Blog::IsActive()->paginate(8);
        return view('blog',
            compact('title', 'blog')
        );
    }
    public function blog_detail($code){
        $code = strtolower(trim($code));
        $blog = Blog::IsActive()->where('code', $code)->first();
        $title = $blog->title;
        return view('blog_detail',
            compact('title', 'blog')
        );
    }

    //faq
    public function faq(){
        $title = 'Faq';
        $faq = Faq::IsActive()->get();

        return view('faq',
            compact('title', 'faq')
        );
    }

    //faq
    public function live(){
        $title = 'Live';
        $live = Live::IsActive()->orderBy('date', 'desc')->paginate(6);

        //Осталось дней
        $days_left = Subscription::where('user_id', Auth::id())
            ->where(DB::raw('DATE_ADD(start_date, INTERVAL day DAY)'), '>=', date("Y.m.d H:i:s"))
            ->sum('day');

        return view('live',
            compact('title', 'live', 'days_left')
        );
    }



}
