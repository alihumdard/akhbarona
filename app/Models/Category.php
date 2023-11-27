<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ["category_name", "parent_cat", "order_num", "article_num", "template", "css", "view_subcat", "redirect", "image", "sefriendly", "article_template"];
    static function getList($keyword = '') {
        $categories = self::orderBy('order_num','ASC');
        if($keyword) {
            $categories = $categories->whereRaw(('category_name like "%'.$keyword.'%" OR sefriendly like "%'.$keyword.'%"'));
        }
        $categories = $categories->get();
        $arrCat = array();
        if($categories) {
            foreach ($categories as $cat) {
                if($cat->parent_cat > 0) {
                    if(!isset($arrCat[$cat->parent_cat])) {
                        $arrCat[$cat->parent_cat] = [];
                        $arrCat[$cat->parent_cat]['child'] = [];
                    } else if(!isset($arrCat[$cat->parent_cat]['child'])) {
                        $arrCat[$cat->parent_cat]['child'] = [];
                    }
                    $arrCat[$cat->parent_cat]['child'][] = $cat->toArray();
                } else {
                    $arrCat[$cat->id] = $cat->toArray();
                }
            }
        }
        return $arrCat;
    }
}
