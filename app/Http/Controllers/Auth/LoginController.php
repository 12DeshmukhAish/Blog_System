<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/posts';


    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');  // Make sure this matches the route name
        }
        return redirect()->route('posts.index');
    }
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Constructor is now empty as middleware is defined in the route file
    }

    /**
     * Get the middleware for this controller's actions.
     *
     * @return array
     */
    public static function middleware()
    {
        return [
            'guest' => ['except' => ['logout']],
            'auth' => ['only' => ['logout']]
        ];
    }
}