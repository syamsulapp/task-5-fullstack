<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Articles;
use Illuminate\Http\Request;

class LandingPage extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $categories;
    protected $articles;
    public function index(Categories $categories, Articles $articles)
    {
        $data = array(
            'categories' => $categories->all(),
            'articles' => $articles->all(),
        );

        return view('welcome', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
}
