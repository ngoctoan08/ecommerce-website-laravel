<?php

use App\Http\Controllers\Api\v1\ApiCategoryController;
use App\Http\Controllers\Api\v1\ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    Route::prefix('category')->group(function() {
        Route::post('multipleDelete', [ApiCategoryController::class, 'multipleDelete'])->name('category.multipleDelete');
        Route::post('multiplefDelete', [ApiCategoryController::class, 'multiplefDelete'])->name('category.multiplefDelete');
        Route::post('multipleRestore', [ApiCategoryController::class, 'multipleRestore'])->name('category.multipleRestore');
        Route::get('trash', [ApiCategoryController::class, 'trash'])->name('category.trash');
        Route::get('restore/{id}', [ApiCategoryController::class, 'restore'])->name('category.restore');
        Route::delete('fDelete/{id}', [ApiCategoryController::class, 'fDelete'])->name('category.fDelete');
    });

    Route::prefix('product')->group(function() {
        Route::post('multipleDelete', [ApiProductController::class, 'multipleDelete'])->name('product.multipleDelete');
        Route::post('multiplefDelete', [ApiProductController::class, 'multiplefDelete'])->name('product.multiplefDelete');
        Route::post('multipleRestore', [ApiProductController::class, 'multipleRestore'])->name('product.multipleRestore');
        Route::get('trash', [ApiProductController::class, 'trash'])->name('product.trash');
        Route::get('restore/{id}', [ApiProductController::class, 'restore'])->name('product.restore');
        Route::delete('fDelete/{id}', [ApiProductController::class, 'fDelete'])->name('product.fDelete');
    });

    Route::resource('category', 'Api\v1\ApiCategoryController');
    Route::resource('product', 'Api\v1\ApiProductController');

});
