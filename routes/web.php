
<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\SocialAuthController;
// use App\Http\Controllers\PostController;
// use App\Http\Controllers\CommentController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // Social Authentication Routes
// Route::get('auth/{provider}', [SocialAuthController::class, 'redirectToProvider']);
// Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);

// Route::resource('posts', PostController::class);
// Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
// Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
// // Admin Routes
// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// }); 






use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'showRegistrationForm')->name('register');
    Route::post('register', 'register');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'authenticate');
    Route::post('logout', 'logout')->name('logout');
});

// Public routes
Route::get('/', [PostController::class, 'index'])->name('home');
Auth::routes();

// Post routes group
Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
    Route::post('/', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
    Route::put('/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
    
    Route::group(['prefix' => 'posts/{post}/comments'], function () {
        Route::post('/', [CommentController::class, 'store'])
            ->name('comments.store')
            ->middleware('auth');
        Route::put('/{comment}', [CommentController::class, 'update'])
            ->name('comments.update')
            ->middleware('auth');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])
            ->name('comments.destroy')
            ->middleware('auth');
    });
// Admin routes group
// Route::group([
//     'prefix' => 'admin',
//     'middleware' => ['auth', 'admin'],
//     'as' => 'admin.'
// ], function () {
//     Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
//     // Admin post management
//     Route::resource('posts', AdminPostController::class)->except(['create', 'store']);
    
//     // Admin user management
//     Route::resource('users', AdminUserController::class)->except(['create', 'store']);
// });


Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'admin'],
    'as' => 'admin.',
    // 'namespace' => 'Admin'  // If you're using namespace
], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    // ->name('admin.dashboard');
    
 // Remove namespace from controller reference since we're using full class names
 Route::resource('posts', AdminPostController::class)->except(['create', 'store']);
 Route::resource('users', AdminUserController::class)->except(['create', 'store']);
});
});