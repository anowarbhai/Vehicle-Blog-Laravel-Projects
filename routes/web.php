<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminBlogsController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminPrivacyController;
use App\Http\Controllers\Admin\AdminTermsController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('/');


Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/search', [BlogController::class, 'search'])->name('search');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/blog/{slug}', [BlogController::class, 'details'])->name('blogs.details');

Route::get('/contact', [ContactController::class, 'index'])->name('pages.contact');
Route::post('/savecontact', [ContactController::class, 'store'])->name('savecontact');

Route::get('/privacy', [PrivacyController::class, 'index'])->name('pages.privacy');
Route::get('/terms', [TermsController::class, 'index'])->name('pages.terms');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');



/* Admin auth */

Auth::routes();
Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/blogs', [AdminBlogsController::class, 'index'])->name('admin.blogs.index');
Route::get('/admin/blog/create', [AdminBlogsController::class, 'create'])->name('admin.blogs.create');
Route::post('/admin/blog/store', [AdminBlogsController::class, 'store'])->name('admin.blog.store');
Route::get('/admin/blog/show/{id}', [AdminBlogsController::class, 'show'])->name('admin.blogs.show');
Route::get('/admin/blog/edit/{id}', [AdminBlogsController::class, 'edit'])->name('admin.blogs.edit');
Route::put('/admin/blog/update/{id}', [AdminBlogsController::class, 'update'])->name('admin.blog.update');
Route::delete('/admin/blog/delete/{id}', [AdminBlogsController::class, 'destroy'])->name('admin.blog.destroy');


Route::get('/admin/category', [AdminCategoryController::class, 'index'])->name('admin.category.index');
Route::get('/admin/category/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
Route::post('/admin/category/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
Route::get('/admin/category/show/{id}', [AdminCategoryController::class, 'show'])->name('admin.category.show');
Route::get('/admin/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
Route::put('/admin/category/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
Route::delete('/admin/category/delete/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');


Route::get('/admin/contact', [AdminContactController::class, 'index'])->name('admin.pages.contact');
Route::get('/admin/contact/show/{id}', [AdminContactController::class, 'show'])->name('admin.contact.show');
Route::delete('/admin/contact/delete/{id}', [AdminContactController::class, 'destroy'])->name('admin.contact.destroy');

Route::get('/admin/privacy', [AdminPrivacyController::class, 'index'])->name('admin.pages.privacy');
Route::put('/admin/privacy/update/{id}', [AdminPrivacyController::class, 'update'])->name('admin.privacy.update');


Route::get('/admin/terms', [AdminTermsController::class, 'index'])->name('admin.pages.terms');
Route::put('/admin/terms/update/{id}', [AdminTermsController::class, 'update'])->name('admin.terms.update');


Route::get('/admin/settings', [AdminSettingsController::class, 'index'])->name('admin.settings.index');
Route::post('/admin/settings/update', [AdminSettingsController::class, 'update'])->name('admin.settings.update');


Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.settings.profile');
Route::put('/admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');

