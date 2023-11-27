<?php
namespace App\Repositories\Category;
interface CategoryRepository {
    function getAll();
    function getMenu();
    function getBySlug($slug);
    function getById($id);
}
