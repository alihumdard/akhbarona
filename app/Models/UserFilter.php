<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFilter extends Model
{
    protected $table = 'user_filters';
    public $timestamps = false;
    static function getFilter($userId,$section='article') {
        $arrResult = [];
        $filters = self::where('user_id',$userId)->where('section',$section)->orderBy('id','DESC')->get();
        if($filters) {
            foreach ($filters as $filter) {
                $url = route($section.'.index');
                $query = base64_decode($filter->query);
                $queryStr = '';
                if($query) {
                    $arrQuery = unserialize($query);
                    foreach ($arrQuery as $key=>$vl) {
                        if($queryStr) {
                            $queryStr .= '&';
                        }
                        if(is_array($vl)) {
                            //dd($vl);
                            foreach ($vl as $key1=>$vl1) {
                                if($queryStr) {
                                    $queryStr .= '&';
                                    $queryStr .= $key.'[]='.$vl1;
                                }
                            }
                        } else {
                            $queryStr .= $key.'='.$vl;
                        }
                    }
                }
                if($queryStr) {
                    $url .= '?'.$queryStr;
                }

                $arrResult[] = ['id'=>$filter->id,'name'=>$filter->name,'url'=>$url];
            }
        }
        return $arrResult;
    }
}
