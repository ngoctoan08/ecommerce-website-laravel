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
    // hanlde product
    Route::resource('product', 'Admin\ProductController');
    // handle unit
    Route::resource('unit', 'Admin\UnitController');
    Route::resource('provider', 'Admin\ProviderController');
    
    Route::prefix('import_export')->group(function () { 
        Route::get('{id}/add', [
            'as' => 'import_export.add', 
            'uses' => 'Admin\ImportExportController@add', 
        ]);
        
        // update status of order
        Route::post('{id}/{idImportExport}', [
            'as' => 'import_export.update-status',
            'uses' => 'Admin\ImportExportController@updateStatus',
        ]);
        // show order detail
        Route::get('{id}/{idImportExport}', [
            'as' => 'import_export.show-detail',
            'uses' => 'Admin\ImportExportController@showDetail',
        ]);

        
    // Route::get('import_export/{id}/add', [ImportExportController::class, 'add'])->name('import_export.add');
        
    });
    // Route::get('import_export/{id}/add', [ImportExportController::class, 'add'])->name('import_export.add');
    // Route::get('import_export/{id}/{idImportExport}', [ImportExportController::class, 'showDetail'])->name('import_export.show-detail');    
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
    Route::get('/gio-hang', [
        'as' => 'gio-hang',
        'uses' => 'Web\CartController@index'
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

        Route::post('/update-qty-in-cart', [
            'as' => 'web-product.update-qty-in-cart', //name of route
            'uses' => 'Web\CartController@updateQtyInCart', // 
        ]);

        Route::post('/search-item', [
            'as' => 'web-product.search-item', //name of route
            'uses' => 'Web\ProductController@searchItem', // 
        ]);
        
        // post data to san-pham/id
        Route::post('/feedback', [
            'as' => 'web-product.store-feedback', //name of route
            'uses' => 'Web\ProductController@storeFeedback', // 
        ])->middleware('auth');

        
    });

    
    // 1. Show list item in cart
    Route::group(['prefix' => 'gio-hang'], function() { 
        Route::get('/', [
            'as' => 'web-cart.index', //name of route
            'uses' => 'Web\CartController@index', // 
        ]);
    });

    // checkout
    Route::group(['prefix' => 'thanh-toan', 'middleware' => ['auth']], function() { 
        Route::get('/', [
            'as' => 'web-checkout.index', //name of route
            'uses' => 'Web\CheckoutController@index', // 
        ]);

        Route::get('/thanh-cong', [
            'as' => 'web-checkout.pay-success', //name of route
            'uses' => 'Web\CheckoutController@paySuccess', // 
        ]);
  
        
        Route::post('/web-checkout.store', [
            'as' => 'web-checkout.store', //name of route
            'uses' => 'Web\CheckoutController@handleCheckout', // 
        ]);
    });

    Route::group(['prefix' => 'don-hang'], function() { 
        Route::get('/', [
            'as' => 'web-order.index', //name of route
            'uses' => 'Web\UserController@showOrdered', // 
        ]);
        Route::get('/{id}', [
            'as' => 'web-order.show', //name of route
            'uses' => 'Web\UserController@showDetailOrdered', // 
        ]);
    });
    
    
});
Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});