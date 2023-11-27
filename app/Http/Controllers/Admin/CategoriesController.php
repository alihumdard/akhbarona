<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Models\AdminLog;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:category.manage');

    }
    public function index(Request $request) {
        $keyword = $request->get('search');
        $categories = Category::getList($keyword);
        return view('admin.category.index',['categories'=>$categories]);
    }
    public function create()
    {
        $edit = false;
        $arrCat = Category::getList();
        return view('admin.category.add-edit', compact('edit','arrCat'));
    }
    public function edit($catId)
    {
        $edit = true;
        $cate = Category::find($catId);
        $arrCat = Category::getList();
        if(!$cate) {
            return redirect()->route('category.index')
                ->withErrors(trans('app.not_existing_category'));
        }
        return view(
            'admin.category.add-edit',
            compact('edit', 'cate','arrCat')
        );
    }
    public function store(Request $request,$catId=0)
    {
        //dd($catId);die;
        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key=>$vl) {
            $data[$key] = htmlspecialchars_decode($vl);
        }
        if($catId != 0) {
            $this->validate($request, [
                'category_name' => 'required|unique:categories,category_name,'.$catId,

            ]);
            $category = Category::find($catId);
            Category::where('id',$catId)->update($data);
            Cache::forget("cate_".$category->sefriendly);
        } else {
            //dd($request->all());
            $this->validate($request, [
                'category_name' => 'required|unique:categories',

            ]);
            $maxOrderNum = Category::selectRaw("max(order_num) as max_num")->first();
            $data["order_num"] = 0;
            if($maxOrderNum && $maxOrderNum->max_num) {
                $data["order_num"] = $maxOrderNum->max_num;
            }
            Category::create($data);
        }
        Cache::forget('all_categories');
        Common::delCacheMenu();

        return redirect()->route('category.index')
            ->withSuccess($catId == 0?trans('app.category_created'):trans('app.category_updated'));
    }
    public function sort(Request $request) {
        $data = $request->all();
        //dd($data);
        if(isset($data['listId']) and $data['listId']) {
            $categories = Category::whereIn('id',$data['listId'])->orderBy('order_num','ASC')->select(['id','order_num'])->get();
            if($categories) {
                $arrOrderNum = [];
                $arrObject = [];
                foreach ($categories as $category) {
                    $arrOrderNum[] = $category->order_num;
                    $arrObject[$category->id] = $category;
                }
                //dd($arrOrderNum);
                foreach ($data['listId'] as $index=>$id) {
                    echo $index.',';
                    if(isset($arrObject[$id]) && isset($arrOrderNum[$index])) {
                        $arrObject[$id]->order_num = $arrOrderNum[$index];
                        $arrObject[$id]->save();
                    }
                }
                $logMessage = 'Reordered categories # ' . trim(implode(',',$data['listId']));
                AdminLog::insert(['user_name'=>Auth::user()->username,'action'=>$logMessage]);
                unset($arrOrderNum);
                unset($arrObject);
                unset($articles);
                Common::delCacheMenu();
            }
        }
        return response()->json('ok');
    }
    public function delete($catId)
    {
        $category = Category::find($catId);
        Category::where('id',$catId)->delete();
        Category::where('parent_cat',$catId)->delete();
        Cache::forget('all_categories');
        Cache::forget('menu_categories');
        Cache::forget("cate_".$category->sefriendly);
        Common::delCacheMenu();
        return redirect()->route('category.index')
            ->withSuccess(trans('app.category_deleted'));
    }

}
