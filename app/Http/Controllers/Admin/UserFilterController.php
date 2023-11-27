<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\File\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserFilter as ModelUserFilter;

class UserFilterController extends Controller
{
    public function __construct(FileRepository $fileRepository)
    {
        $this->middleware('auth');
    }
    public function saveSearchFilter(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        $userFilter = new \App\Models\UserFilter();
        $userFilter->section = $data['section'];
        $userFilter->name = $data['name'];
        unset($data['name']);
        unset($data['section']);
        $userFilter->query = base64_encode(serialize($data));
        $userFilter->user_id = Auth::user()->id;
        $userFilter->save();
        if($userFilter AND $userFilter->id) {
            return response()->json(["error"=>0,"message"=>"Saved is successfully!"]);
        }
        return response()->json(["error"=>1,"message"=>"Error: Saved is fail!"]);
    }
    public function delFilter(ModelUserFilter $userFilter) {
        $section = $userFilter->section;
        $userFilter->delete();
        if($section == 'article') {
            return redirect()->route('article.index')
                ->withSuccess("You deleted success!");
        }
    }
}
