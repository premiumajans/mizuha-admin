<?php

//Backend Controllers
use App\Http\Controllers\Backend\HomeController as BHome;
use App\Http\Controllers\Backend\LanguageController as LChangeLan;
use App\Http\Controllers\Backend\SettingController as BSetting;
use App\Http\Controllers\Backend\SiteLanguageController as BSiteLan;
use App\Http\Controllers\Backend\AdminController as BAdmin;
use App\Http\Controllers\Backend\InformationController as BInformation;
use App\Http\Controllers\Backend\ReportController as BReport;
use App\Http\Controllers\Backend\PermissionController as BPermission;
use App\Http\Controllers\Backend\StatusController as BStatus;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ContactInfoController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\MessageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'backend.', 'middleware' => 'auth:sanctum', 'backendLanguage'], function () {

    //General
    Route::get('/menu-status/change/{name}', [BStatus::class, 'change'])->name('menuStatus');
    Route::get('/change-language/{lang}', [LChangeLan::class, 'switchLang'])->name('switchLang');
    Route::get('/', [BHome::class, 'index'])->name('index');
    Route::get('/dashboard', [BHome::class, 'index'])->name('dashboard');
    Route::get('/reports', [BReport::class, 'index'])->name('report');
    Route::get('/give-permission', [BPermission::class, 'givePermission'])->name('givePermission');
    Route::get('/give-permission-to-user/{user}', [BPermission::class, 'giveUserPermission'])->name('giveUserPermission');
    Route::post('/give-permission-to-user-update', [BPermission::class, 'giveUserPermissionUpdate'])->name('givePermissionUserUpdate');
    //Statuses
    Route::get('/site-language/{id}/change-status', [BSiteLan::class, 'siteLanStatus'])->name('siteLanStatus');
    Route::get('/social-status/{id}/change-status', [SocialController::class, 'socialStatus'])->name('social-status');
    //Delete
    Route::get('/site-languages/{id}/delete', [BSiteLan::class, 'delSiteLang'])->name('delSiteLang');
    Route::get('/settings/{id}/delete', [BSetting::class, 'delSetting'])->name('delSetting');
    Route::get('/users/{id}/delete', [BAdmin::class, 'delAdmin'])->name('delAdmin');
    Route::get('/report/{id}/delete', [BReport::class, 'delReport'])->name('delReport');
    Route::get('/report/clean-all', [BReport::class, 'cleanAllReport'])->name('cleanAllReport');
    Route::get('/permission/{id}/delete', [BPermission::class, 'delPermission'])->name('delPermission');
    Route::get('/slider/{id}/delete', [SliderController::class, 'destroy'])->name('slider.destroy');
    Route::get('/category/{id}/delete', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/products/{id}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/about/{id}/delete', [AboutController::class, 'destroy'])->name('about.destroy');
    Route::get('/contact-info/{id}/delete', [ContactInfoController::class, 'destroy'])->name('contact-info.destroy');
    Route::get('/social/{id}/delete', [SocialController::class, 'destroy'])->name('social.destroy');
    Route::get('/message/{id}/delete', [MessageController::class, 'destroy'])->name('message.destroy');

    Route::resource('/site-languages', BSiteLan::class);
    Route::resource('/settings', BSetting::class);
    Route::resource('/users', BAdmin::class);
    Route::resource('/my-informations', BInformation::class);
    Route::resource('/permissions', BPermission::class);
    Route::resource('/slider', SliderController::class)->except(['show','destroy']);
    Route::resource('/category', CategoryController::class)->except(['show','destroy']);
    Route::resource('/products', ProductController::class)->except(['show','destroy']);
    Route::resource('/about', AboutController::class)->except(['show','destroy','create','store']);
    Route::resource('/contact-info', ContactInfoController::class)->except(['show','destroy']);
    Route::resource('/social', SocialController::class)->except(['show','destroy']);
    Route::resource('/message', MessageController::class)->only(['index','show','destroy']);

    Route::get('/clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('clear-compiled');
        Artisan::call('config:cache');
        dd("Cache cleared");
    });
});

Route::group(['prefix' => '/', 'as' => 'frontend.', 'middleware' => 'frontLanguage'], function () {
    Route::get('/change-language/{dil}', [LChangeLan::class, 'frontLanguage'])->name('frontLanguage');
});
