<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class AdminController extends Controller 
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_posts' => Post::count(),
            'total_comments' => Comment::count(),
            'recent_posts' => Post::with('user')->latest()->take(5)->get(),
            'recent_users' => User::latest()->take(5)->get(),
        ];

        // return view('admin.dashboard');
        return view('admin.dashboard', compact('stats'));
    }
}