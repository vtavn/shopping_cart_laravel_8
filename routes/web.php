<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/login', [AdminController::class, 'loginAdmin'])->name('login');
    Route::post('/login', [AdminController::class, 'postLoginAdmin']);

    // home
    Route::get('/', [AdminController::class, 'index'])->name('index');

    //category
    Route::prefix('categories')->middleware('can:categories')->name('categories.')->group(function (){
        Route::get('/', [CategoryController::class, 'index'])->name('index')->can('viewAny', Category::class);

        Route::get('/create', [CategoryController::class, 'create'])->name('create')->can('create', Category::class);
        Route::post('/store', [CategoryController::class, 'store'])->name('store')->can('create', Category::class);

        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit')->can('update', Category::class);
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update')->can('update', Category::class);

        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete')->can('delete', Category::class);
    });

    //Menu
    Route::prefix('menus')->middleware('can:menus')->name('menus.')->group(function (){
        Route::get('/', [MenuController::class, 'index'])->name('index');

        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/store', [MenuController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [MenuController::class, 'update'])->name('update');

        Route::get('/delete/{id}', [MenuController::class, 'delete'])->name('delete');
    });

    //Product
    Route::prefix('products')->name('products.')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('index');

        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');

        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
    });

    //Slider
    Route::prefix('sliders')->name('sliders.')->group(function (){
        Route::get('/', [SliderController::class, 'index'])->name('index');

        Route::get('/create', [SliderController::class, 'create'])->name('create');
        Route::post('/store', [SliderController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('update');

        Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('delete');
    });

    //Users
    Route::prefix('users')->name('users.')->group(function (){
        Route::get('/', [AdminUserController::class, 'index'])->name('index');

        Route::get('/create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/store', [AdminUserController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('update');

        Route::get('/delete/{id}', [AdminUserController::class, 'delete'])->name('delete');
    });

    //Setting
    Route::prefix('settings')->name('settings.')->group(function (){
        Route::get('/', [SettingController::class, 'index'])->name('index');

        Route::get('/create', [SettingController::class, 'create'])->name('create');
        Route::post('/store', [SettingController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SettingController::class, 'update'])->name('update');

        Route::get('/delete/{id}', [SettingController::class, 'delete'])->name('delete');
    });

    //Roles
    Route::prefix('roles')->name('roles.')->group(function (){
        Route::get('/', [AdminRoleController::class, 'index'])->name('index');

        Route::get('/create', [AdminRoleController::class, 'create'])->name('create');
        Route::post('/store', [AdminRoleController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [AdminRoleController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AdminRoleController::class, 'update'])->name('update');

        Route::get('/delete/{id}', [AdminRoleController::class, 'delete'])->name('delete');
    });

    //Permission
    Route::prefix('permissions')->name('permissions.')->group(function (){
        Route::get('/', [AdminPermissionController::class, 'index'])->name('index');

        Route::get('/create', [AdminPermissionController::class, 'create'])->name('create');
        Route::post('/store', [AdminPermissionController::class, 'store'])->name('store');

        Route::get('/edit/{permission}', [AdminPermissionController::class, 'edit'])->name('edit');
        Route::post('/edit/{permission}', [AdminPermissionController::class, 'update']);

        Route::get('/delete/{permission}', [AdminPermissionController::class, 'delete'])->name('delete');
    });

});
