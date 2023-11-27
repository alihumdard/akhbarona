<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\ArticleIAttachment;
use App\Models\ArticleImage;
use App\Models\AssetFile;
use App\Models\AssetFileType;
use App\Repositories\File\EloquentFile;
use App\Repositories\File\FileRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Psy\Util\Str;

class FileController extends Controller
{
    protected $perPage = 20;
    protected $repoFile = null;
    public function __construct(FileRepository $fileRepository)
    {
        $this->middleware('auth');
        $this->repoFile = $fileRepository;
        $setting = \App\Models\Config::getAllValue();
        if($setting AND isset($setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"])) {
            Config::set("app.timezone",$setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"]);
        }
    }
    public function getListFolder(Request $request) {
        $childFolders = array();
        $fileConfig = Config::get('site.files');
        $year = date('Y');
        $checkFolder = AssetFile::where('filetype_id',6)->where('name',$year)->first();
        if(!$checkFolder) {
            $createPath = public_path($fileConfig.'/'.$year);
            //echo $createPath;die;
            mkdir($createPath,0755);
            if(is_dir($createPath)) {
                AssetFile::insert(['name'=>$year,'path'=>$fileConfig.'/','extension'=>'.dirext','path_md5'=>md5($fileConfig.'/'.$year.'/'),'mtime'=>date('Y-m-d H:i:s'),'filetype_id'=>6]);
            }
        }
        $childFolders = AssetFile::where('filetype_id',6)->where("path","like","%files%")->orderBy("name","ASC")->get();
        $fileType = $request->type_file;
        $isMultiple = (int)$request->is_multiple;
        $path = $request->path;
        if(!$path) {
            $path = $fileConfig."/";
        }
        $keyword = trim($request->keyword);
        if($keyword) {
            $files = AssetFile::where('name',"like","%".$keyword."%")->orderBy('id','desc');
        } else {
            $files = AssetFile::where('path',$path)->orderBy('id','desc');
        }
        $fileTypeWhere = $fileType;
        if($fileTypeWhere == 100) {
            $fileTypeWhere = 1;
        }
        if($fileType) {
            $files->where('filetype_id',$fileTypeWhere);
        }
        $currentPage = $request->page;
        if($currentPage > 1) {
            $files = $files->paginate($this->perPage,['*'],'page',$currentPage)->onEachSide(1);
        } else {
            $files = $files->paginate($this->perPage)->onEachSide(1);
        }
        $arrFilter = request()->all();

        if(isset($arrFilter['page'])) {
            unset($arrFilter['page']);
        }
        if(isset($arrFilter['_token'])) {
            unset($arrFilter['_token']);
        }
        //print_r($arrFilter);die;
        $fileRepo = $this->repoFile;
        $onlyFile = $request->only_file;
        if($onlyFile) {
            return view('admin.file.include.browse',compact('fileConfig','files','fileRepo','fileType','isMultiple','arrFilter','path','keyword'));
        }
        return view('admin.file.modal_body_data',compact('fileConfig','childFolders','files','fileRepo','fileType','isMultiple','arrFilter','path','keyword'));
    }
    public function upload(Request $request) {
        $arrResult = ['error'=>0,'data'];
        $setting = \App\Models\Config::getAllValue();

        $allow = isset($setting['VIVVO_ALLOWED_EXTENSIONS'])?explode(',',$setting['VIVVO_ALLOWED_EXTENSIONS']):[];
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $name = preg_replace("/\.".$ext."$/",'',$file->getClientOriginalName());
        $size = $file->getSize();
        $mineType = $file->getMimeType();
        $fileTypeId = AssetFileType::getTypeId($ext);
        $imageInfo = null;
        if(strpos($mineType,'image') !== false) {
            $imageInfo = getimagesize($file);
        }
        $fileType = $request->file_type;
        if($fileType == 100) {
            $fileType = 1;
        }
        if(!$fileTypeId || !in_array($ext,$allow) || ($fileType && $fileTypeId != $fileType)) {
            $arrResult['error'] = 1;
            $arrResult['data'] = 'Error: The file type "'.$ext.'" is not support!';
            return response()->json($arrResult);
        }
        $path = $request->path;
        $uploadDes = public_path($path);
        $nameDes = $name.'_'.time();
        if($file->move($uploadDes,$nameDes.'.'.$ext)) {
            $assetFile = new AssetFile();
            $assetFile->name = $nameDes;
            $assetFile->extension = $ext;
            $assetFile->path = $path.'/';
            $assetFile->path_md5 = md5($assetFile->path);
            $assetFile->size = $size;
            if($imageInfo && isset($imageInfo[0])) {
                $assetFile->width = $imageInfo[0];
                $assetFile->height = $imageInfo[1];
            }
            $assetFile->filetype_id = $fileTypeId;
            $assetFile->mtime = date('Y-m-d H:i:s');
            $assetFile->scanned = 1;
            $assetFile->save();
            if($assetFile->id) {
                $arrResult['data'] = $path.'/'.$nameDes.'.'.$ext;
                AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>'Uploaded file '.$arrResult['data']]);
                $fileName = str_replace(Config::get('site.files').'/','',$arrResult['data']);
                if($fileTypeId == 1) {
                    $fileRepo = new EloquentFile();
                    $fileRepo->createAllThumbs($fileName);
                }
                $selectType = $request->select_type;
                if($selectType == 'list_gallery_image' && $request->article_id) {
                    $articleImg = ArticleImage::selectRaw('max(order_number) as order_num')->first();
                    $orderNum = $articleImg?($articleImg->order_num+1):0;
                    ArticleImage::insert(['article_id'=>$request->article_id,'real_path'=>$fileName,'order_number'=>$orderNum]);
                    $arrArticleFiles = ArticleImage::where('article_id',$request->article_id)->orderBy('order_number','ASC')->get();
                    $repoFile = new EloquentFile();
                    $arrResult['data'] = view('admin.article.partials.gallery', compact('arrArticleFiles','repoFile'))->render();


                } elseif ($selectType == 'multiple_attachments_holder' && $request->article_id) {
                    $articleImg = ArticleIAttachment::selectRaw('max(order_number) as order_num')->first();
                    $orderNum = $articleImg?($articleImg->order_num+1):0;
                    ArticleIAttachment::insert(['article_id'=>$request->article_id,'real_path'=>$fileName,'order_number'=>$orderNum]);
                    $arrArticleFiles = ArticleIAttachment::where('article_id',$request->article_id)->orderBy('order_number','ASC')->get();
                    $arrResult['data'] = view('admin.article.partials.attachment', compact('arrArticleFiles'))->render();
                }
            } else {
                $arrResult['error'] = 1;
                $arrResult['data'] = "Error: Uploaded is fail";
            }
        } else {
            $arrResult['error'] = 1;
            $arrResult['data'] = "Error: Uploaded is fail";
        }
        return response()->json($arrResult);

    }
    public function index(Request $request) {
        $folders = AssetFile::where("filetype_id",6)->where("path","like","%files%")->orderBy("id","DESC")->get();
        $setting = \App\Models\Config::getAllValue();
        $extensions = explode(',',$setting["VIVVO_ALLOWED_EXTENSIONS"]);
        $perPage = $request->per_page?$request->per_page:10;
        $files = AssetFile::where("filetype_id","!=",6)->orderBy("id","desc");
        if($request->name) {
            $files->where("name","like","%".trim($request->name)."%");
        }
        if($request->path) {
            $files->where("path",$request->path);
        }
        if($request->extension) {
            $files->where("extension",$request->extension);
        }
        $arrFiler = request()->input();

        if(isset($arrFiler['page'])) {
            unset($arrFiler['page']);
        }
        $files = $files->paginate($perPage);
        $files->appends($arrFiler)->links();
        $fileRepo = $this->repoFile;
        return view("admin.file.index",compact("folders","extensions","files","perPage","fileRepo"));
    }
    public function download(AssetFile $file) {
        $path = public_path($file->path);
        //dd($file);
        $fileName = $file->name.'.'.$file->extension;
        if(file_exists($path.$fileName)) {
            return response()->download($path.$fileName,$fileName);
        }
        return 'file is not existing!';
    }
    public function delete(AssetFile $file) {
        $path = public_path($file->path);
        $fileName = $file->name.'.'.$file->extension;
        if(file_exists($path.$fileName)) {
            unlink($path.$fileName);
        }
        $file->delete();
        return response()->json(["error"=>0,"message"=>"file deleted successfully!"]);
    }
}
