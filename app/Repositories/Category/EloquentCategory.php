<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class EloquentCategory implements CategoryRepository
{
    function getAll()
    {
        $keyCache = 'all_categories';
        $categories = Cache::get($keyCache);
        if (!$categories) {
            $objects = Category::orderBy('order_num', 'ASC')->get();
            $categories = [];
            foreach ($objects as $cat) {
                $categories[$cat->id] = $cat;
            }
            Cache::forever($keyCache, $categories);
        }
        return $categories;
    }
    function getMenu()
    {
        $keyCache = 'menu_categories';
        $categories = Cache::get($keyCache);
        if (!$categories) {
            $categories = Category::where("view_subcat", 1)->where("parent_cat", 0)->orderBy('order_num', 'ASC')->get();
            Cache::forever($keyCache, $categories);
        }
        return $categories;
    }
    function getBySlug($slug)
    {
        $keyCache = "cate_" . $slug;
        $category = Cache::get($keyCache);
        if (!$category) {
            $category = Category::where("sefriendly", $slug)->first();
            Cache::forever($keyCache, $category);
        }
        return $category;
    }
    function getById($id)
    {
        $categories = $this->getAll();
        if (isset($categories[$id])) {
            return $categories[$id];
        }
        return null;
    }
}
