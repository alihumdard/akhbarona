<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\Comment;
use App\Models\Page;
use App\Models\UserFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:page.manage');
        $setting = \App\Models\Config::getAllValue();
        if($setting AND isset($setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"])) {
            Config::set("app.timezone",$setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"]);
        }
    }
    public function index(Request $request) {
        $pages = Page::orderBy('order_number','DESC')->get();
        return view('admin.page.index',compact('pages'));
    }
    public function edit(Request $request,Page $page) {
        return response()->json($page);
    }
    public function store(Request $request, Page $page=null) {
        try {
            $data = $request->all();
            $id = $data['page_id'];
            unset($data['page_id']);
            unset($data['_token']);
            $message = "Page created successfully!";
            if($id) {
                Page::where('id',$id)->update($data);
                AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>'edited page #'.$id]);
                $message = "Page updated successfully!";
            } else {
                $num = Page::selectRaw('max(order_number) as max_num')->first();
                $orderNum = 0;
                if($num) {
                    $orderNum = $num->max_num + 1;
                }
                $data['order_number'] = $orderNum;
                $id = \DB::getPdo()->lastInsertId();
                AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>'added page #'.$id]);
            }
            return redirect()->route('page.index')
                ->withSuccess($message);

        } catch (\Exception $exception) {
            return response()->json(["error"=>1,"message"=>$exception->getMessage()]);
        }
    }
    public function delete(Page $page) {
        $id = $page->id;
        $title = $page->title;
        $page->delete();

        AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>'Deleted pages # '.$id.' title#'.$title]);
        return redirect()->route('page.index')
            ->withSuccess("You deleted success!");
    }
    public function sort(Request $request) {
        try {
            $arrId = $request->listId;
            //dd($arrId);
            if($arrId) {
                $index = $total = count($arrId);
                for ($i = 0; $i < $total; $i++) {
                    $page = Page::find($arrId[$i]);
                    $page->order_number = $index--;
                    $page->save();
                }
            }
            return response()->json(["error"=>0,"message"=>"Pages was reordered successfully."]);
        } catch (\Exception $exception) {
            return response()->json(["error"=>1,"message"=>$exception->getMessage()]);
        }

    }
}
