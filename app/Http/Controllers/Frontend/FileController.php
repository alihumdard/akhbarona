<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class FileController extends Controller
{
    function file(Request $request) {
        //dd($request->all());
        $fileConfig = Config::get('site.files');
        if($request->file) {
            $filename = str_replace('logs/', '', $request->file);
            $filename = str_replace('..', '', $filename);
            $file = public_path($fileConfig.'/'.$filename);
            if (file_exists($file) and !is_link($file) and !is_dir($file)) {
                return response()->file($file);
            }
        }
        abort(404);
    }
    function thumbnail(Request $request) {
        $filename = str_replace('..', '', $request->file);
        $ext = strtolower( substr($filename, strrpos($filename, ".")) );
        if ($ext != '.jpg' && $ext != '.gif' && $ext != '.png' && $ext != '.jpeg'){
            abort(404);
        }
        $size = 'thumbview';
        if ($request->size){
            $size = $request->size;
        }
        $fileRepo = new \App\Repositories\File\EloquentFile();
        $fileRepo->isFile = true;
        $image = $fileRepo->checkFile($size,$filename,"");
        $fileRepo = null;
        //dd($image);
        return response()->file(public_path($image));
    }
}
