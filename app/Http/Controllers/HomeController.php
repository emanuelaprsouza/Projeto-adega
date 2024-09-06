<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $category->image_url = $category->getFirstMediaUrl('images');
        }

        return view('catalog/home', compact('categories'));
    }
}
