<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
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
//auth routes
Route::get('login/page',[\App\Http\Controllers\Auth\LoginController::class,'loginPage'])->name('login.page');
Route::post('login/process',[\App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
//end

//gallery register
Route::get('gallery/register/page', [\App\Http\Controllers\GalleryRegisterController::class,'registerPage'])->name('gallery.register.page');
Route::post('gallery/register', [\App\Http\Controllers\GalleryRegisterController::class,'register'])->name('gallery.register');
Route::get('gallery/register/success', [\App\Http\Controllers\GalleryRegisterController::class,'successPage'])->name('gallery.register.success');
//end

Route::middleware('auth:admin')->group(function () {

    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logoutAdmin'])->name('logout');

    Route::get('admin/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::middleware('permission:manage categories')->group(function () {
        Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    });

    Route::middleware('permission:manage admins')->group(function () {
        Route::resource('admins', \App\Http\Controllers\AdminController::class);
        Route::get('admin/{admin}/roles/page', [\App\Http\Controllers\RoleController::class,'adminrolespage'])->name('admin.roles.page');
        Route::post('admin/{admin}/roles', [\App\Http\Controllers\RoleController::class,'storeadminroles'])->name('admin.roles.store');
    });

    Route::middleware('permission:manage users')->group(function () {
        Route::resource('users', \App\Http\Controllers\UserController::class);
    });

    Route::middleware('permission:manage artists')->group(function () {
        Route::resource('artists', \App\Http\Controllers\ArtistController::class);

        //news
        Route::get('news/{artist_id}', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
        Route::get('news/{artist_id}/create', [\App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
        Route::post('news/{artist_id}/store', [\App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
        Route::get('news/{news_id}/edit',[\App\Http\Controllers\NewsController::class,'edit'])->name('news.edit');
        Route::patch('news/{news_id}/update',[\App\Http\Controllers\NewsController::class,'update'])->name('news.update');
        Route::delete('news/{news_id}/destroy',[\App\Http\Controllers\NewsController::class,'destroy'])->name('news.destroy');
        //end
    });

    Route::middleware('permission:manage galleryings')->group(function () {
        Route::resource('gallerying', \App\Http\Controllers\GalleryingController::class);
        Route::get('gallerying/index/{gallery_id}', [\App\Http\Controllers\GalleryingController::class,'indexgallerying'])->name('index.gallerying');
        Route::post('gallerying/store/{gallery_id}', [\App\Http\Controllers\GalleryingController::class,'storegallerying'])->name('store.gallerying');
        Route::get('gallerying/create/{gallery_id}', [\App\Http\Controllers\GalleryingController::class,'creategallerying'])->name('create.gallerying');
    });

    Route::middleware('permission:manage roles')->group(function () {
        Route::resource('roles', \App\Http\Controllers\RoleController::class);
        Route::get('roles/{role}/permissions', [\App\Http\Controllers\RoleController::class,'rolepermissionpage'])->name('role.permission.page');
        Route::post('roles/{role}/permissions', [\App\Http\Controllers\RoleController::class,'storePermissions'])->name('role.permissions.store');
    });

    Route::middleware('permission:manage permissions')->group(function () {
        Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    });

    Route::middleware('permission:manage galleries')->group(function () {
        //region galleries
        Route::resource('galleries', \App\Http\Controllers\GalleryController::class);
        Route::get('locations/{gallery_id}/create', [\App\Http\Controllers\LocationController::class, 'create'])->name('locations.create');
        Route::post('locations/{gallery_id}/store', [\App\Http\Controllers\LocationController::class, 'store'])->name('locations.store');
        //end
    });

    Route::middleware('permission:manage assets')->group(function () {
        //region assets
        Route::resource('assets', \App\Http\Controllers\AssetController::class);
        //end

        //contracts region
        Route::get('contracts/{asset_id}',[\App\Http\Controllers\ContractController::class,'index'])->name('contracts.index');
        Route::get('contracts/{asset_id}/create',[\App\Http\Controllers\ContractController::class,'create'])->name('contracts.create');
        Route::delete('contracts/{id}/destroy',[\App\Http\Controllers\ContractController::class,'destroy'])->name('contracts.destroy');
        Route::post('contracts/store',[\App\Http\Controllers\ContractController::class,'store'])->name('contracts.store');
        //end

        //region videos
        Route::get('videos/{asset_id}',[\App\Http\Controllers\VideoController::class,'index'])->name('videos.index');
        Route::get('videos/{asset_id}/create',[\App\Http\Controllers\VideoController::class,'create'])->name('videos.create');
        Route::patch('videos/{asset_id}/update',[\App\Http\Controllers\VideoController::class,'update'])->name('videos.update');
        Route::delete('videos/{asset_id}/destroy',[\App\Http\Controllers\VideoController::class,'destroy'])->name('videos.destroy');
        Route::get('videos/{asset_id}/edit',[\App\Http\Controllers\VideoController::class,'edit'])->name('videos.edit');
        Route::post('videos/{asset_id}/store',[\App\Http\Controllers\VideoController::class,'store'])->name('videos.store');
        //end
    });



    //region media
    Route::post('upload/{mediable_type}/{mediable_id}', [ \App\Http\Controllers\MediaController::class, 'uploadFile' ])->name('uploadFile');
    Route::get('media/upload/page/{type}/{id}',[\App\Http\Controllers\MediaController::class,'uploadPage'])->name('upload.page');
    Route::post('upload/main/{mediable_type}/{mediable_id}', [ \App\Http\Controllers\MediaController::class, 'uploadMainFile' ])->name('uploadFile.main');
    Route::get('media/upload/page/main/{type}/{id}',[\App\Http\Controllers\MediaController::class,'uploadPageMain'])->name('upload.page.main');
    Route::post('media/home/page/{id}',[\App\Http\Controllers\MediaController::class,'homepage'])->name('homepage.media');
    Route::post('upload/edit/{mediable_type}/{mediable_id}', [ \App\Http\Controllers\MediaController::class, 'uploadFileEdit' ])->name('uploadFile.update');
    Route::get('media/edit/upload/page/{type}/{id}',[\App\Http\Controllers\MediaController::class,'uploadEditPage'])->name('upload.page.edit');
    Route::post('upload/edit/main/{mediable_type}/{mediable_id}', [ \App\Http\Controllers\MediaController::class, 'uploadMainFileEdit' ])->name('uploadFile.main.update');
    Route::get('media/edit/upload/page/main/{type}/{id}',[\App\Http\Controllers\MediaController::class,'uploadEditPageMain'])->name('upload.page.main.edit');
    Route::get('media/index/page/{type}/{id}',[\App\Http\Controllers\MediaController::class,'index'])->name('media.index');
    Route::delete('media/delete/main/{type}/{id}',[\App\Http\Controllers\MediaController::class,'deleteMain'])->name('media.main.delete');
    Route::delete('media/delete/{type}/{id}',[\App\Http\Controllers\MediaController::class,'delete'])->name('media.delete');

    //end

    //video link
    Route::post('video/link/{type}/{id}',[\App\Http\Controllers\VideoLinkController::class,'store'])->name('videoLink.store');
    Route::get('video/links/{type}/{id}',[\App\Http\Controllers\VideoLinkController::class,'index'])->name('videoLink.index');
    Route::delete('video/link/{id}/destroy',[\App\Http\Controllers\VideoLinkController::class,'destroy'])->name('videos.destroy');


    //redirect region
    Route::get('redirect/{route}',function ($route) {
        return redirect()->route($route);
    })->name('redirect');

    Route::get('redirect/{route}/{arguments}',function ($route,$arguments) {
        return redirect()->route($route,$arguments);
    })->name('redirect.with.arguments');
    //end
});

