<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Empty constructor - middleware is defined in middleware method
    }

    /**
     * Get the middleware for this controller.
     *
     * @return array
     */
    public static function middleware()
    {
        return [
            'auth' => ['only' => ['index']]
        ];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}