<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Factory;

class UploadImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function CkeditorUploadImage(Request $request, Factory $validator)
    {

        $valid = $validator->make($request->all(), [
            'upload' => 'mimes:jpeg,jpg,gif,png'
        ]);

        $funcNum = $request->input('CKEditorFuncNum');

        if ($valid->fails()) {
            return response(
                "<script>
                    window.parent.CKEDITOR.tools.callFunction({$funcNum}, '', '{$v->errors()->first()}');
                </script>"
            );
        }

        $file = $request->file('upload');
        $patch = 'upload/';
        $file_name = $file->hashName();
        $file->move($patch, $file_name);
        $url = '/'.$patch.$file_name;

        return response(
            "<script>
                window.parent.CKEDITOR.tools.callFunction({$funcNum}, '{$url}', 'Изображение успешно загружено');
            </script>"
        );

    }

}