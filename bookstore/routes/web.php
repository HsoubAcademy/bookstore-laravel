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

Auth::routes();

Route::prefix('/admin')->middleware('can:update-books')->group(function() {
    Route::get('/', 'AdminsController@index')->name('admin.index'); 

    Route::resource('/books', 'BooksController');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/publishers', 'PublishersController');
    Route::resource('/authors', 'AuthorsController');
    Route::resource('/users', 'UsersController')->middleware('can:update-users');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'GalleryController@index')->name('gallery.index');
Route::get('/search', 'GalleryController@search')->name('search');

Route::get('/book/{book}', 'BooksController@details')->name('book.details');
Route::post('/book/{book}/rate', 'BooksController@rate')->name('book.rate');

Route::get('/categories', 'CategoriesController@list')->name('gallery.categories.index');
Route::get('/categories/search', 'CategoriesController@search')->name('gallery.categories.search');
Route::get('/categories/{category}', 'CategoriesController@result')->name('gallery.categories.show');

Route::get('/publishers', 'PublishersController@list')->name('gallery.publishers.index');
Route::get('/publishers/search', 'PublishersController@search')->name('gallery.publishers.search');
Route::get('/publishers/{publisher}', 'PublishersController@result')->name('gallery.publishers.show');

Route::get('/authors', 'AuthorsController@list')->name('gallery.authors.index');
Route::get('/authors/search', 'AuthorsController@search')->name('gallery.authors.search');
Route::get('/authors/{author}', 'AuthorsController@result')->name('gallery.authors.show');

Route::post('/cart', 'CartController@addToCart')->name('cart.add');
Route::get('/cart', 'CartController@viewCart')->name('cart.view');
Route::post('/removeOne/{book}', 'CartController@removeOne')->name('cart.remove_one');
Route::post('/removeAll/{book}', 'CartController@removeAll')->name('cart.remove_all');