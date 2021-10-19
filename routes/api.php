<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('facade', function () {
    return \Settings::getGroup();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('drive/upload', 'Api\DriveController@store');
Route::delete('drive/delete/{id}', 'Api\DriveController@destroy');

Route::resource("setting-groups", "Api\SettingGroupController");
Route::resource("settings", "Api\SettingController");

Route::post('auth/register', 'Api\AuthController@register');
Route::post('auth/login', 'Api\AuthController@login');
Route::post('auth/logout', 'Api\AuthController@logout');
Route::get('auth/refresh', 'Api\AuthController@refresh');
Route::get('auth/profile', 'Api\AuthController@profile');

Route::get('auth/reset-password/{token}', 'Api\AuthController@passwordFindReset');
Route::put('auth/reset-password', 'Api\AuthController@passwordReset');
Route::post('auth/reset-password', 'Api\AuthController@passwordRecover');

Route::get('auth/email/verify/{id}', 'Api\AuthController@verifyEmail')->name('verification.verify');
Route::post('auth/email/resend', 'Api\AuthController@resendVerifyEmail')->name('verification.send');

Route::post('uploads', function (Request $request) {

    $request->validate([
        'file' => 'required|mimes:csv,txt,xlx,xls,pdf,jpg,png|max:2048'
    ]);

    try {
        $fileName = time() . '_' . Str::slug(explode('.', $request->file('file')->getClientOriginalName())[0]);
        $filePath = $request->file('file')->storeAs('uploads', $fileName . '.' . $request->file('file')->getClientOriginalExtension(), 'public');
        return response()->json([
            'message' => 'File uploaded',
            'data' => [
                'name' => $fileName,
                'path' => '/storage/' . $filePath,
                'url' => env('app_url') . '/storage/' . $filePath
            ]
        ], 201);
    } catch (Exception $exception) {
        return response()->json([
            'message' => $exception->getMessage(),
            'errors' => [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]
        ], 400);
    }

});

// generated section


// BOOKS
Route::get("books/export", ['as' => 'api.books.export', 'uses' => 'Api\BookController@export']);
Route::put("books/delete-multiple", ['as' => 'api.books.delete-multiple', 'uses' => 'Api\BookController@destroyMultiple']);
Route::resource("books","Api\BookController");


// AUTHORS
Route::get("authors/export", ['as' => 'api.authors.export', 'uses' => 'Api\AuthorController@export']);
Route::put("authors/delete-multiple", ['as' => 'api.authors.delete-multiple', 'uses' => 'Api\AuthorController@destroyMultiple']);
Route::resource("authors","Api\AuthorController");


// TAGS
Route::get("tags/export", ['as' => 'api.tags.export', 'uses' => 'Api\TagController@export']);
Route::put("tags/delete-multiple", ['as' => 'api.tags.delete-multiple', 'uses' => 'Api\TagController@destroyMultiple']);
Route::resource("tags","Api\TagController");


// GENRES
Route::get("genres/export", ['as' => 'api.genres.export', 'uses' => 'Api\GenreController@export']);
Route::put("genres/delete-multiple", ['as' => 'api.genres.delete-multiple', 'uses' => 'Api\GenreController@destroyMultiple']);
Route::resource("genres","Api\GenreController");





// end section

// USERS
Route::get('users/export', ['as' => 'api.users.export', 'uses' => 'Api\UserController@export']);
Route::put("users/delete-multiple", ['as' => 'api.users.delete-multiple', 'uses' => 'Api\UserController@destroyMultiple']);
Route::resource("users", "Api\UserController");

// PERMISSIONS
Route::put("permissions/delete-multiple", ['as' => 'api.permissions.delete-multiple', 'uses' => 'Api\UserPermissionController@destroyMultiple']);
Route::resource("permissions", "Api\UserPermissionController");

// ROLES
Route::put("roles/delete-multiple", ['as' => 'api.roles.delete-multiple', 'uses' => 'Api\UserRoleController@destroyMultiple']);
Route::resource("roles", "Api\UserRoleController");

