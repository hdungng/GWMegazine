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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.main-page');
Route::get('/home-contribution/{id}', [App\Http\Controllers\HomeController::class, 'detail'])->name('home.detail');
Route::post('/home-contribution/search', [App\Http\Controllers\HomeController::class, 'search'])->name('home.search');
Route::get('/home-contribution/filter/{id}', [App\Http\Controllers\HomeController::class, 'filter'])->name('home.filter');
Route::get('/get-total-like/{id}', [App\Http\Controllers\LikeController::class, 'getTotalLike'])->name('home.getTotalLike');


Route::prefix('contributions')->middleware('role.auth:Student')->group(function () {
    Route::post('/like', [App\Http\Controllers\LikeController::class, 'like'])->name('home.like');


    Route::get('', [App\Http\Controllers\HomeContributionController::class, 'index'])->name('home.contributions.index');
    Route::get('/create', [App\Http\Controllers\HomeContributionController::class, 'create'])->name('home.contributions.create');
    Route::get('/detail/{id}', [App\Http\Controllers\HomeContributionController::class, 'detail'])->name('home.contributions.detail');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeContributionController::class, 'edit'])->name('home.contributions.edit');
    Route::post('/store', [App\Http\Controllers\HomeContributionController::class, 'store'])->name('home.contributions.store');
    Route::post('/comment/{id}', [App\Http\Controllers\HomeContributionController::class, 'comment'])->name('home.contributions.comment');
    Route::post('/update/{id}', [App\Http\Controllers\HomeContributionController::class, 'update'])->name('home.contributions.update');
    Route::post('/delete', [App\Http\Controllers\HomeContributionController::class, 'delete'])->name('home.contributions.delete');
});

Route::get('/content-policy', [App\Http\Controllers\HomeOtherPagesController::class, 'content_policy'])->name('home.content-policy');
Route::get('/user-agreement', [App\Http\Controllers\HomeOtherPagesController::class, 'user_agreement'])->name('home.user-agreement');
Route::get('/help', [App\Http\Controllers\HomeOtherPagesController::class, 'help'])->name('home.help');


Route::prefix('user-profile')->middleware('role.auth:Student,Guest')->group(function () {
    Route::get('/{id}', [App\Http\Controllers\HomeProfileController::class, 'index'])->name('home.user-profile');
    Route::post('/update-info/{id}', [App\Http\Controllers\HomeProfileController::class, 'update_info'])->name('home.profile.update-info');
    Route::post('/update-password/{id}', [App\Http\Controllers\HomeProfileController::class, 'update_password'])->name('home.profile.update-password');
});



Auth::routes();

Route::prefix('admin')->middleware('role.auth:Root,Admin,Coordinator')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Define child routes (CRUD operations)
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [App\Http\Controllers\AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/store', [App\Http\Controllers\AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{id}', [App\Http\Controllers\AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::post('/update/{id}', [App\Http\Controllers\AdminUserController::class, 'update'])->name('admin.users.update');
        Route::post('/delete', [App\Http\Controllers\AdminUserController::class, 'delete'])->name('admin.users.delete');
    });


    Route::prefix('contributions')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminContributionController::class, 'index'])->name('admin.contributions.index');
        Route::get('/detail/{id}', [App\Http\Controllers\AdminContributionController::class, 'detail'])->name('admin.contributions.detail');
        Route::get('/preview/{id}', [App\Http\Controllers\AdminContributionController::class, 'preview'])->name('admin.contributions.preview');
        Route::get('/edit/{id}', [App\Http\Controllers\AdminContributionController::class, 'edit'])->name('admin.contributions.edit');
        Route::post('/comment/{id}', [App\Http\Controllers\AdminContributionController::class, 'comment'])->name('admin.contributions.comment');
        Route::post('/publish', [App\Http\Controllers\AdminContributionController::class, 'publish'])->name('admin.contributions.publish');
        Route::post('/update/{id}', [App\Http\Controllers\AdminContributionController::class, 'update'])->name('admin.contributions.update');
        Route::post('/delete', [App\Http\Controllers\AdminContributionController::class, 'delete'])->name('admin.contributions.delete');
    });


    Route::prefix('faculty')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminFacultyController::class, 'index'])->name('admin.faculty.index');
        Route::post('/store', [App\Http\Controllers\AdminFacultyController::class, 'store'])->name('admin.faculty.store');
        Route::post('/update', [App\Http\Controllers\AdminFacultyController::class, 'update'])->name('admin.faculty.update');
        Route::post('/delete', [App\Http\Controllers\AdminFacultyController::class, 'delete'])->name('admin.faculty.delete');
    });

    Route::prefix('activity-logs')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminActivityLogController::class, 'index'])->name('admin.activity-logs.index');
    });

    Route::prefix('academic-year')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminAcademicYearController::class, 'index'])->name('admin.academic-year.index');
        Route::post('/store', [App\Http\Controllers\AdminAcademicYearController::class, 'store'])->name('admin.academic-year.store');
        Route::post('/update', [App\Http\Controllers\AdminAcademicYearController::class, 'update'])->name('admin.academic-year.update');
        Route::post('/status', [App\Http\Controllers\AdminAcademicYearController::class, 'changeStatus'])->name('admin.academic-year.status');
        Route::post('/delete', [App\Http\Controllers\AdminAcademicYearController::class, 'delete'])->name('admin.academic-year.delete');
    });

    Route::prefix('user-profile')->group(function () {
        Route::get('/{id}', [App\Http\Controllers\AdminProfileController::class, 'index'])->name('admin.user-profile');
        Route::post('/update-info/{id}', [App\Http\Controllers\AdminProfileController::class, 'update_info'])->name('admin.profile.update-info');
        Route::post('/update-password/{id}', [App\Http\Controllers\AdminProfileController::class, 'update_password'])->name('admin.profile.update-password');
    });
});
