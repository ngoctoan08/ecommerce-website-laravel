<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes(); //Generate route of Auth: eg: login, logout, password,...

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function() {

    Route::get('/', [
        'as' => 'admin',
        'uses' => 'AdminController@index'
    ]);
    
    //hien thi home admin
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [
            'as' => 'admin.dashboard',
            'uses' => 'AdminController@index'
        ]);
    });
        
        //su dung them cac action trong cung 1 nhom chu de
    Route::prefix('category')->group(function () {
        //khi click vao add cua san pham
        // Route::post('/store', [
        //     'as' => 'category.store', //action create
        //     'uses' => 'TestController@store', // su dung ham add cua CategoryController
        // ]);
        
        Route::get('/', [
            'as' => 'category.index', //action create
            'uses' => 'Admin\CategoryController@index', // su dung ham index cua CategoryController
        ]);

        // list trashed
        Route::get('/trash', [
            'as' => 'category.trash', //action trash
            'uses' => 'Admin\CategoryController@trash', // su dung ham trash cua CategoryController
        ]);

        Route::get('/edit/{id}', [
            'as' => 'category.edit', //action edit
            'uses' => 'Admin\CategoryController@edit', // su dung ham edit cua CategoryController
        ]);

        Route::put('/update/{id}', [
            'as' => 'category.update', //action update
            'uses' => 'Admin\CategoryController@update', // su dung ham update cua CategoryController
        ]);

        Route::post('/handle-action', [
            'as' => 'category.handle-action', //action handleAction
            'uses' => 'Admin\CategoryController@handleAction', // su dung ham handleAction cua CategoryController
        ]);

        // Route::get('/delete/{id}', [
        //     'as' => 'category.delete', //action delete
        //     'uses' => 'CategoryController@delete', // su dung ham delete cua CategoryController
        // ]);

        // Route::get('/force-delete/{id}', [
        //     'as' => 'category.force-delete', //action delete
        //     'uses' => 'CategoryController@force_delete', // su dung ham delete cua CategoryController
        // ]);
        // //phuong thuc post, gui form len server
        // Route::post('/store', [
        //     'as' => 'category.store', //action store
        //     'uses' => 'CategoryController@store',
        // ]);

        // Route::get('/trash', [
        //     'as' => 'category.trash', //action trash
        //     'uses' => 'CategoryController@trash',
        // ]);
        // Route::get('/restore/{id}', [
        //     'as' => 'category.restore', //action trash
        //     'uses' => 'CategoryController@restore',
        // ]);
    });

    //menu Process
    Route::resource('menu', 'Admin\MenuController');

    //**
    //Product Process
    //su dung them cac action trong cung 1 nhom chu de
    Route::get('product/{id}/import_export', [ProductController::class, 'import_export'])->name('product.import_export');
    Route::resource('product', 'Admin\ProductController');
    Route::resource('unit', 'Admin\UnitController');
    Route::resource('provider', 'Admin\ProviderController');
    Route::resource('import_export', 'Admin\ImportExportController');
});

Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});