<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::controller(AuthController::class)->group(function(){
    Route::post('/register', 'register');
    Route::get("/email_confirm/{email}/{verification_code}",  "email_confirm")->where(['email' => '.*@.*\..*', 'verification_code' => '[A-Za-z0-9]+']);
    Route::post('login', 'login');
    Route::post("adminregister", 'adminregister');
    Route::post("admin_login", 'admin_login');
});


Route::middleware('auth:sanctum')->group(function(){

    Route::controller(PostController::class)->group(function(){
        Route::post('/createblog', 'createblog');
        Route::put('/updateblog', 'updateblog');
        Route::delete("deleteblog", 'deleteblog');
        Route::post('createcomment', 'createcomment');
        Route::post('/deletecomment', 'deletecomment');
    });

    Route::controller(GetController::class)->group(function(){
        Route::get('blogsstories', 'blogsstories');
        Route::get('blogsingle/{id}', 'blogsingle');
        Route::get('commentview', 'commentview');

    });
});
