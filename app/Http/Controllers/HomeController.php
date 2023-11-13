<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if ( isset( auth()->user()->is_admin ) && ! auth()->user()->is_admin == 1 ) {
            return view('home');
        } else {

            $blogs = Blog::where('status', 1)->get();

            return view('index', compact('blogs'));
        }
    }


}
