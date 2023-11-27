<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config as SysConfig;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    protected $settings = null;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:setting.manage');
        $this->settings = SysConfig::getAllValue();
        $setting = $this->settings;
        if($setting AND isset($setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"])) {
            Config::set("app.timezone",$setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"]);
        }
    }
    public function edit($type, Request $request) {
        $timezones = timezone_identifiers_list();
        $settings = $this->settings;
        return view('admin.setting.setting',compact('type','settings','timezones'));
    }
    public function store($type, Request $request) {
        $data = $request->all();
        unset($data["_token"]);

        foreach ($data as $key=>$vl) {
            $setting = SysConfig::where("variable_name",$key)->first();
            if($setting) {
                $setting->variable_value = $vl;
                $setting->save();
            }
        }
        SysConfig::delCache();
        return redirect(route('setting.edit',[$type]))->withSuccess("Updated ".$type." setting is successfully!");
    }
}
