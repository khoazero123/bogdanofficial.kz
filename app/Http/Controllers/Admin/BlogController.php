<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Helpers\Helper;
use File;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $title = 'Блог';

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

        $blog = Blog::orderby('id', 'desc')->paginate(10);

        return view('admin.blog',
            compact('title', 'blog', 'breadcrumb')
        );
    }

    public function delete($id){
        $blog = Blog::find($id);
        if($blog)
        {
            File::delete('upload/' . $blog->image);
            if($blog->delete())
                return redirect('/admin/blog')->with('message', 'Успешно удалено');
        }
    }

    public function _save(Request $request, $id = 0){
            //валидация
            $this->validate($request,
                [
                    'title' => 'required|max:255',
                    'code' => ['required','max:255',
                        Rule::unique('blog')->where(function ($query) use ($id) {
                            return $query->where('id','<>', $id);
                        })
                    ],
                    'text' => 'required',
                ]
            );
            $data = $request->all();
            $blog = $id ? Blog::find($id) : (isset($data['title']) ? new Blog() : null);
            $blog->title = $data['title'];
            $blog->code =  Helper::generate_chpu($data['code']);
            $blog->text = $data['text'];
            $blog->active = isset($data['active']) ? $data['active'] : 0;

            //фото
            if(isset($data['image'])){
                $new_logo = time() . rand() . $data['image']->getClientOriginalName();
                if($data['image']->move('upload/', $new_logo)){
                    //удаляем старый логотип
                    if(!empty($blog->logo) and isset($data['id']))
                        File::delete('upload/' . $blog->image);
                    $blog->image = $new_logo;
                }
            }

            $blog->save();
            return redirect('/admin/blog/save/' . $blog->id)->with('message', 'Успешно сохранено');

    }

    public function  save($id = 0)
    {
        $blog = $id ? Blog::find($id) : new Blog();
        $title = $id == 0 ? 'Создать' : $blog->title;
        $breadcrumb = array(
            array(
                'link' => '/admin/',
                'title' => 'Главная',
            ),
            array(
                'link' => '/admin/blog',
                'title' => 'Блог',
            ),
            array(
                'link' => '',
                'title' => $title,
            )
        );


        return view('admin.blog_save',
            compact('title', 'blog', 'breadcrumb')
        );
    }


}