<?php

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

Route::prefix('/admin')->middleware('can:update-books')->group(function() {
    Route::get('/', 'App\Http\Controllers\AdminsController@index')->name('admin.index');

    Route::resource('/books', 'App\Http\Controllers\BooksController');
    Route::resource('/categories', 'App\Http\Controllers\CategoriesController');
    Route::resource('/publishers', 'App\Http\Controllers\PublishersController');
    Route::resource('/authors', 'App\Http\Controllers\AuthorsController');
    Route::resource('/users', 'App\Http\Controllers\UsersController')->middleware('can:update-users');
});

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/', 'App\Http\Controllers\GalleryController@index')->name('gallery.index');
Route::get('/search', 'App\Http\Controllers\GalleryController@search')->name('search');

Route::get('/book/{book}', 'App\Http\Controllers\BooksController@details')->name('book.details');
Route::post('/book/{book}/rate', 'App\Http\Controllers\BooksController@rate')->name('book.rate');

Route::get('/categories', 'App\Http\Controllers\CategoriesController@list')->name('gallery.categories.index');
Route::get('/categories/search', 'App\Http\Controllers\CategoriesController@search')->name('gallery.categories.search');
Route::get('/categories/{category}', 'App\Http\Controllers\CategoriesController@result')->name('gallery.categories.show');

Route::get('/publishers', 'App\Http\Controllers\PublishersController@list')->name('gallery.publishers.index');
Route::get('/publishers/search', 'App\Http\Controllers\PublishersController@search')->name('gallery.publishers.search');
Route::get('/publishers/{publisher}', 'App\Http\Controllers\PublishersController@result')->name('gallery.publishers.show');

Route::get('/authors', 'App\Http\Controllers\AuthorsController@list')->name('gallery.authors.index');
Route::get('/authors/search', 'App\Http\Controllers\AuthorsController@search')->name('gallery.authors.search');
Route::get('/authors/{author}', 'App\Http\Controllers\AuthorsController@result')->name('gallery.authors.show');

Route::post('/cart', 'App\Http\Controllers\CartController@addToCart')->name('cart.add');
Route::get('/cart', 'App\Http\Controllers\CartController@viewCart')->name('cart.view');
Route::post('/removeOne/{book}', 'App\Http\Controllers\CartController@removeOne')->name('cart.remove_one');
Route::post('/removeAll/{book}', 'App\Http\Controllers\CartController@removeAll')->name('cart.remove_all');


