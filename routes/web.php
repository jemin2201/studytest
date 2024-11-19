<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('secondhand/Dashboard');
    })->name('dashboard');


    // resource 한번에 여리 리소스 컨트롤러를 등록할 수있다
    Route::resource('/Posts', PostController::class)->names([
        'index' => 'Posts.index',
        'show' => 'PostShow',
        'create' => 'Postcreate',
        'store' => 'Poststore',
        'edit' => 'PostEdit',
        'update' => 'Posts.update',
    ]);

    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    })->name('home');
});

