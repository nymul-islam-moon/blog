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
        return view('admin.home', compact( 'comments', 'categories', 'posts', 'users' ));
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
