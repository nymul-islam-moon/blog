<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        $comments = 0;
        $categories = BlogCategory::count();
        $posts = Blog::count();
        $users = User::count();
        $latest_users = User::latest()->take(5)->get();
        $latest_blogs = Blog::latest()->take(5)->get();

        return view('admin.home', compact( 'comments', 'categories', 'posts', 'users', 'latest_users', 'latest_blogs' ));
    }

    /**
     * Admin Custome Logout
     */

     public function logout()
     {
        Auth::logout();

        $notification = array('message' => 'You are logged out!', 'alert-type' => 'success');

        return redirect()->route('admin.login')->with($notification);
     }
}
