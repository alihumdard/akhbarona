<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $keyCache = "admin_dashboard";
        $arrLog = Cache::get($keyCache);
        if(!$arrLog) {
            $article = Article::selectRaw('sum(today_read) as total')->first();
            $articleToday = $article->total;
            $commentToday = Comment::where('create_dt','>=',date('Y-m-d'))->count();
            $articlePending = Article::where('status',0)->count();
            $commentPending = Comment::where('status',0)->count();
            $arrLog = ["today_a"=>$articleToday,"today_c"=>$commentToday,'pending_a'=>$articlePending,"pending_c"=>$commentPending];
            Cache::set($keyCache,$arrLog,now()->addMinutes(30));
        } else {
            $articleToday = $arrLog["today_a"];
            $commentToday = $arrLog["today_c"];
            $articlePending = $arrLog["pending_a"];
            $commentPending = $arrLog["pending_c"];
        }
        return view('admin.dashboard.default',compact('articleToday','commentToday','articlePending','commentPending'));
    }
    public function log() {
        $logs = AdminLog::orderBy('id','DESC')->paginate(100);
        return view('admin.dashboard.log',compact('logs'));
    }
    public function test() {
        echo date('d M Y H:i:s');
    }

}
