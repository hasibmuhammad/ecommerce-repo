<?php

namespace App\Controllers\Backend;

use App\Controllers\Controller;
use Respect\Validation\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getIndex()
    {
        view('backend/category/index');
    }
    public function postIndex()
    {
        $errors = [];
        $validator = new Validator();
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $status = $_POST['status'];

        if($validator::alpha()->validate($title) === false){
            $errors[] = "This only can contain Alphabet";
        }
        if($validator::slug()->validate($slug) === false){
            $errors[] = "Slug must be valid slug";
        }

        if(empty($errors)){
            Category::create([
                'title' => $title,
                'slug'  => $slug,
                'active' => $status
            ]);
            $_SESSION['success'] = "Category Created!";
            redirect('categories');
        }
        $_SESSION['errors'] = $errors;
        redirect('categories');
    }
}
