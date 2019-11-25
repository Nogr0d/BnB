<?php

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');


Route::get('/listing/create', 'ListingController@create')->name('listing.create');
Route::post('/listing/create', 'ListingController@store')->name('listing.store');
Route::post('/listing/block', 'ListingController@blockDates')->name('listing.block');

Route::get('/listing/{id}', 'HomeController@showListing')->name('listing.show');
Route::post('/listing/{id}', 'HomeController@bookNow')->name('listing.book');

Route::get('/payment/success', 'ReservationController@paypalCallback')->name('paypal');


Route::get('/my-listings', 'ListingController@index')->name('listing.index');
Route::get('/my-listings/{id}', 'ListingController@details')->name('listing.details');
Route::get('/my-listings/{id}/toggle', 'ListingController@toggle')->name('listing.toggle');
Route::get('/my-listings/{id}/edit', 'ListingController@edit')->name('listing.edit');
Route::post('/my-listings/{id}/edit', 'ListingController@update')->name('listing.update');





Route::post('/my-listings/{id}/gallery/add', 'ImageController@store')->name('image.store');
Route::get('/listing/gallery/{id}/delete', "ImageController@delete")->name('image.delete');

Route::get('/my-bookings', 'ReservationController@index')->name('reservations.index');
Route::get('/my-bookings/{id}', 'ReservationController@show')->name('reservations.show');

Route::get('/my-bookings/{id}/cancel', 'ReservationController@cancel')->name('reservations.cancel');


Route::post('/my-bookings/{id}/rate', 'ReviewController@add')->name('reservations.rate');


Route::post('/reservations/{id}', 'ReservationController@chat')->name('reservations.chat');

Route::get('/guestlist', 'ReservationController@guestlist')->name('guestlist.index');
Route::get('/guestlist/{id}', 'ReservationController@guestlistShow')->name('guestlist.show');

Route::post('/listing/prices/create', 'PriceController@store')->name('price.store');
Route::get('/listing/prices/{id}/delete', "PriceController@delete")->name('price.delete');


Route::get('/my-listings/reservations/{id}/delete', 'ListingController@deleteBlockedDates')->name('listing.unblock');



