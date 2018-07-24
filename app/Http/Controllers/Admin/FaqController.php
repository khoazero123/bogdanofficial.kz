<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faq;
use File;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $title = 'FAQ';

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

        $faq = Faq::orderby('sort', 'asc')->paginate(10);

        return view('admin.faq',
            compact('title', 'faq', 'breadcrumb')
        );
    }

    public function delete($id){
        $faq = Faq::find($id);
        if($faq)
        {
            File::delete('upload/' . $faq->image);
            if($faq->delete())
                return redirect('/admin/faq')->with('message', 'Успешно удалено');
        }
    }

    public function _save(Request $request, $id = 0){
            //валидация
            $this->validate($request,
                [
                    'data.title' => 'required|max:255',
                    'data.text' => 'required',
                    'data.sort' => 'required'
                ]
            );
            $data = $request->all();
            $faq = $id ? Faq::find($id) : (isset($data['data']) ? new Faq() : null);

            $faq->title  = $data['data']['title'];
            $faq->text   = $data['data']['text'];
            $faq->sort   = $data['data']['sort'];
            $faq->active = isset($data['data']['active']) ? $data['data']['active'] : 0;

            $faq->save();

            return redirect('/admin/faq/save/' . $faq->id)->with('message', 'Успешно сохранено');

    }

    public function  save($id = 0)
    {
        $faq = $id ? Faq::find($id) : new Faq();
        $title = $id==0 ? 'Создать' : $faq->title;
        $breadcrumb = array(
            array(
                'link' => '/admin/',
                'title' => 'Главная',
            ),
            array(
                'link' => '/admin/faq',
                'title' => 'FAQ',
            ),
            array(
                'link' => '',
                'title' => $title,
            )
        );


        return view('admin.faq_save',
            compact('title', 'faq', 'breadcrumb')
        );
    }


}