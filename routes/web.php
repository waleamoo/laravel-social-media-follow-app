<?php
// use Symfony\Component\Routing\Route;
Auth::routes();

Route::get('/', [
    'uses' => 'HomeController@getIndex',
    'as' => 'home'
]);


Route::post('/user/login', [
    'uses' => 'HomeController@postUserLogin',
    'as' => 'userLogin',
    'middleware' => 'guest'
]);

Route::post('/user/register', [
    'uses' => 'HomeController@postUserRegister',
    'as' => 'userRegister',
    'middleware' => 'guest'
]);

Route::get('/user/dashboard', [
    'uses' => 'PostController@getUserDashboard',
    'as' => 'userDashboard',
    'middleware' => 'auth'
]);

Route::post('/user/create', [
    'uses' => 'PostController@postCreatePost',
    'as' => 'postCreate',
    'middleware' => 'auth'
]);

Route::get('/user/account', [
    'uses' => 'HomeController@getAccount',
    'as' => 'account',
    'middleware' => 'auth'
]);

Route::post('/user/account/', [
    'uses' => 'HomeController@postAccount',
    'as' => 'accountSave',
    'middleware' => 'auth'
]);

Route::get('/user/image/{filename}', [
    'uses' => 'HomeController@getUserImage',
    'as' => 'accountImage'
]);


Route::get('/user/delete/{id}', [
    'uses' => 'PostController@getDelete',
    'as' => 'getDelete',
    'middleware' => 'auth'
]);

/*
Route::post('/edit', function (\Illuminate\Http\Request $request) {
    return response()->json(['message' => $request['postId']]);
})->name('edit');
*/

Route::post('/edit', [
    'uses' => 'PostController@postEditPost',
    'as' => 'edit'
]);



