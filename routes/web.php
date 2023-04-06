<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ImportExportController;
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


// Admin page
Route::group(['prefix' => 'admin',  'middleware' => ['auth', 'checkRole']], function() {

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
    Route::get('import_export/{id}/add', [ImportExportController::class, 'add'])->name('import_export.add');
    Route::get('import_export/{id}/{idImportExport}', [ImportExportController::class, 'showDetail'])->name('import_export.show-detail');
    Route::resource('import_export', 'Admin\ImportExportController');
});


// Web page
Route::group(['prefix' => '/'], function() {
    Route::get('/', [
        'as' => '/',
        'uses' => 'HomeController@index'
    ]);
    Route::get('trang-chu', [
        'as' => 'trang-chu',
        'uses' => 'HomeController@index'
    ]);
    Route::get('gioi-thieu', [
        'as' => 'gioi-thieu',
        'uses' => 'HomeController@index'
    ]);
    Route::get('tin-tuc', [
        'as' => 'tin-tuc',
        'uses' => 'HomeController@index'
    ]);
    Route::get('lien-he', [
        'as' => 'lien-he',
        'uses' => 'HomeController@index'
    ]);
    Route::get('/danh-muc', [
        'as' => 'danh-muc',
        'uses' => 'HomeController@category'
    ]);

    Route::group(['prefix' => 'san-pham'], function() { 
        // Show list product by category_id
        // param: title = slug of category
        Route::get('/{title}', [
            'as' => 'web-product.index', //name of route
            'uses' => 'Web\ProductController@index', // 
        ]);
        
        // Show detail product by product_id
        // param: slug = slug of product
        Route::get('/{title}/{id}/{slug}', [
            'as' => 'web-product.show', //name of route
            'uses' => 'Web\ProductController@show', // 
        ]);

        // Handle add to cart
        Route::post('/add-to-cart', [
            'as' => 'web-product.add-to-cart', //name of route
            'uses' => 'Web\CartController@addToCart', // 
        ]);

        Route::post('/del-item-in-cart', [
            'as' => 'web-product.del-item-in-cart', //name of route
            'uses' => 'Web\CartController@delItemInCart', // 
        ]);
        
        // post data to san-pham/id
        Route::post('/feedback/{id}', [
            'as' => 'web-product.store-feedback', //name of route
            'uses' => 'Web\ProductController@storeFeedback', // 
        ]);

        
    });

    
    // 1. Show list item in cart
    Route::group(['prefix' => 'gio-hang'], function() { 

        
    });
});
Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});