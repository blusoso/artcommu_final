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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/startfollow', 'StartfollowController@index')->middleware('auth');
<<<<<<< HEAD
Route::get('/rand', 'StartfollowController@rand')->middleware('auth');
=======
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6

Route::post('/collection/insert', 'CollectionController@insert');
Route::post('/collection/update', 'CollectionController@update');
Route::get('/collection/delete', 'CollectionController@destroy');
Route::post('/collection/fav', 'CollectionController@fav');
Route::get('/collection/{id}/{username}/sorting', 'CollectionController@sorting')->middleware('auth');
Route::get('/collection/{username}', 'CollectionController@index')->middleware('auth');
Route::get('/collection/{username}/following', 'CollectionController@followingcollection')->middleware('auth');
Route::get('/collection/{username}/{title}-{id}', 'CollectionController@show')->middleware('auth');

Route::resource('users', 'CollectionController');
Route::resource('collections', 'CollectionController');

Route::post('/profile/update', 'ProfileController@update');
Route::get('/profile/{username}', 'ProfileController@index')->middleware('auth');
Route::post('/profile/{username}/follow', 'ProfileController@follow')->middleware('auth');
Route::get('/profile/{username}/follower', 'ProfileController@follower')->middleware('auth');
Route::get('/profile/{username}/following', 'ProfileController@following')->middleware('auth');

Route::get('/settings/account', 'SettingAccountController@index')->name('setting.account')->middleware('auth');
Route::post('/settings/account/update', 'SettingAccountController@update');
Route::post('/settings/account/updateimage', 'SettingAccountController@updateimage');

Route::get('/settings/password', 'SettingPasswordController@index')->middleware('auth');
Route::post('/settings/password', 'SettingPasswordController@update')->middleware('auth');

Route::get('/post', 'PostContentController@index')->middleware('auth');
Route::post('/post/insert', 'PostContentController@insert');
Route::get('/post/delete', 'PostContentController@delete');
Route::post('/post/fav', 'PostContentController@fav');
Route::post('/post/favpost', 'PostContentController@favpost');
Route::post('/post/addtocollection', 'PostContentController@addtocollection');

Route::post('/comment/insert', 'CommentController@insert');
Route::get('/comment/delete', 'CommentController@delete');
Route::post('/comment/fav', 'CommentController@fav');

Route::post('/favorite/fav', 'TotalfavController@fav');
Route::post('/favorite/insert', 'TotalfavController@insert');
Route::get('/favorite/{username}', 'TotalfavController@index')->middleware('auth');

Route::get('/favimage/delete', 'FavImageController@delete');
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
