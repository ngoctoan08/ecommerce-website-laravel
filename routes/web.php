<?php


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

//hien thi home admin
Route::get('/dashboard', function () {
    return view('dashboard');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/admin', 'AdminController@loginAdmin');

Route::prefix('admin')->group(function () {

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

    //menu
    Route::prefix('menu')->group(function () {
        //khi click vao add cua san pham
        Route::get('/add', [
            'as' => 'menu.add', //action create
            'uses' => 'MenuController@add', // su dung ham add cua CategoryController
        ]);
        Route::get('/', [
            'as' => 'menu.index', //action create
            'uses' => 'MenuController@index', // su dung ham index cua CategoryController
        ]);

        Route::get('/edit/{id}', [
            'as' => 'menu.edit', //action edit
            'uses' => 'MenuController@edit', // su dung ham edit cua CategoryController
        ]);

        Route::post('/update/{id}', [
            'as' => 'menu.update', //action edit
            'uses' => 'MenuController@update', // su dung ham edit cua CategoryController
        ]);

        Route::get('/delete/{id}', [
            'as' => 'menu.delete', //action delete
            'uses' => 'MenuController@delete', // su dung ham delete cua CategoryController
        ]);

        //phuong thuc post, gui form len server
        Route::post('/store', [
            'as' => 'menu.store', //action store
            'uses' => 'MenuController@store',
        ]);
    });

    //**
    //Product Process
    //su dung them cac action trong cung 1 nhom chu de
    Route::prefix('product')->group(function () {
        Route::get('/', [
            'as' => 'product.index', //action create
            'uses' => 'Admin\ProductController@index', // su dung ham index cua ProductController
        ]);

        Route::post('/store', [
            'as' => 'product.store', //action store
            'uses' => 'Admin\ProductController@store', // su dung ham store cua ProductController
        ]);

        // list trashed
        Route::get('/trash', [
            'as' => 'product.trash', //action trash
            'uses' => 'Admin\ProductController@trash', // su dung ham trash cua ProductController
        ]);

        Route::get('/edit/{id}', [
            'as' => 'product.edit', //action edit
            'uses' => 'Admin\ProductController@edit', // su dung ham edit cua ProductController
        ]);

        Route::put('/update/{id}', [
            'as' => 'product.update', //action update
            'uses' => 'Admin\ProductController@update', // su dung ham update cua ProductController
        ]);

        Route::post('/handle-action', [
            'as' => 'product.handle-action', //action handleAction
            'uses' => 'Admin\ProductController@handleAction', // su dung ham handleAction cua ProductController
        ]);
    });

     //*
});

Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');


Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});