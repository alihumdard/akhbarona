<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\Tag;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function __construct(RoleRepository $roles)
    {
        $this->middleware('auth');
    }
    function quickCreate(Request $request) {
        if($request->label && isset($request->group_id)) {
            $user = Auth::user();
            $tag = new Tag();
            $tag->name = $request->label;
            $tag->sefriendly = Str::slug($request->label);
            $tag->save();
            if(isset($tag->id)) {
                DB::table('tags_to_tags_groups')->insert(['tags_group_id'=>$request->group_id,'tag_id'=>$tag->id]);
                AdminLog::insert(['user_name'=>$user->username,'action'=>'created tag #'.$tag->id]);
                return response()->json(["label"=>$request->label,"value"=>$tag->id,"group_id"=>$request->group_id,"group"=>"Keywords"]);
            }
        }
        return response()->json(['error'=>'Error']);
    }
}
