<?php

require __DIR__.'/auth.php';


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/fetch', [App\Http\Controllers\HomeController::class, 'fetch'])->name('fetch');

Route::post('/send_gpt', [App\Http\Controllers\HomeController::class, 'handle_gpt_send'])->name('send.message');

Route::get('/test', [App\Http\Controllers\HomeController::class, 'test']);

Route::group(['prefix' => '/dashboard', 'middleware' => ['auth' ]], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');



    Route::get('/settings', [App\Http\Controllers\HomeController::class, 'settings'])->name('settings');

    Route::post('/settings', [App\Http\Controllers\HomeController::class, 'store_settings'])->name('settings.store');



    Route::group(['prefix' => 'conversations' , 'middleware'=>'auth'], function () {

        Route::get('/{id}', [App\Http\Controllers\ConversationController::class, 'show'])->name('conversation.show');
    });

    Route::group(['prefix' => 'users' ], function () {
        Route::post('/add', [App\Http\Controllers\UserController::class, 'create'])->name('user.add');

        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users');

        Route::get('/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');

        Route::post('/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

        Route::post('/update_password', [App\Http\Controllers\UserController::class, 'update_password'])->name('user.password.update');

        Route::get('/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

        Route::post('/', [App\Http\Controllers\UserController::class, 'update'])->name('update.user.info');
    });

});





