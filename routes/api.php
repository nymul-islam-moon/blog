<?php

use App\Http\Controllers\API\Frontend\BlogController;
use App\Http\Controllers\API\Frontend\CategoryController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('test', 'test');
});


Route::middleware('auth:sanctum')->get('/user', function ( Request $request ) {
    return $request->user();
});

Route::prefix('blog/admin')->group( function () {

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::controller(BlogCategoryController::class)->prefix('/category')->group(function () {
            Route::get('/', 'index');
            // Route::get('/create', 'create')->name('blog.category.create');
            Route::post('/store', 'store')->name('blog.category.store');
            // Route::get('/{blogCategory}/edit', 'edit')->name('blog.category.edit');
            // Route::put('/{blogCategory}/update', 'update')->name('blog.category.update');
            // Route::post('/{blogCategory}/active', 'active')->name('blog.category.active');
            // Route::post('/{blogCategory}/de-active', 'deactive')->name('blog.category.deactive');
            // Route::delete('/{blogCategory}/destroy', 'destroy')->name('blog.category.destroy');
            // Route::post('/{blogCategory}/restore', 'restore')->name('blog.category.restore');
            // Route::delete('/{blogCategory}/force-delete', 'forceDelete')->name('blog.category.forcedelete');
            // Route::delete('/destroy-all', 'destroyAll')->name('blog.category.destroyAll');
            // Route::delete('/permanent-destroy-all', 'permanentDestroyAll')->name('blog.category.permanentDestroyAll');
            // Route::delete('/restore-all', 'restoreAll')->name('blog.category.restoreAll');
            // Route::get('/get-data', 'getAllData')->name('blog.category.getAllData');
        });
    });
});


/**
 * Frontend API's Routes
 */

 Route::prefix('/')->group( function () {

    Route::controller(CategoryController::class)->prefix('/category')->group(function () {
        Route::get('/', 'index');
    });

    Route::controller(BlogController::class)->prefix('/blog')->group(function () {
        Route::get('/', 'index');
    });
});
