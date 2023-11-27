<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetFileType extends Model
{
    protected $table = 'asset_file_types';
    public $timestamps = false;
    static function getTypeId($ext) {
        $type = self::where('extensions','like','%'.$ext.'%')->first();
        if($type) {
            return $type->id;
        }
        return 0;
    }
}
