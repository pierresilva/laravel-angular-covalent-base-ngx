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

Route::any('{path?}', function () {
    try {
        $index = \File::get(public_path() . '/index.html');
    } catch (Exception $e) {
        return response()->json([
            'message' => 'No existe la aplicación angular!',
        ], 404);
    }
    return $index;
})->where("path", ".+");

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// generated section

Route::get("users/{user}/duplicate", ['as' => 'users.duplicate', 'uses' => 'UserController@duplicate']);
Route::resource("users","UserController");
Route::get("suppliers/{supplier}/duplicate", ['as' => 'suppliers.duplicate', 'uses' => 'SupplierController@duplicate']);
Route::resource("suppliers","SupplierController");
Route::get("supplierHeadquarters/{supplierHeadquarter}/duplicate", ['as' => 'supplierHeadquarters.duplicate', 'uses' => 'SupplierHeadquarterController@duplicate']);
Route::resource("supplierHeadquarters","SupplierHeadquarterController");
Route::get("supplierRates/{supplierRate}/duplicate", ['as' => 'supplierRates.duplicate', 'uses' => 'SupplierRateController@duplicate']);
Route::resource("supplierRates","SupplierRateController");
Route::get("patients/{patient}/duplicate", ['as' => 'patients.duplicate', 'uses' => 'PatientController@duplicate']);
Route::resource("patients","PatientController");
Route::get("customers/{customer}/duplicate", ['as' => 'customers.duplicate', 'uses' => 'CustomerController@duplicate']);
Route::resource("customers","CustomerController");
Route::get("serviceOrders/{serviceOrder}/duplicate", ['as' => 'serviceOrders.duplicate', 'uses' => 'ServiceOrderController@duplicate']);
Route::resource("serviceOrders","ServiceOrderController");
Route::get("examinationTypes/{examinationType}/duplicate", ['as' => 'examinationTypes.duplicate', 'uses' => 'ExaminationTypeController@duplicate']);
Route::resource("examinationTypes","ExaminationTypeController");
Route::get("examinationTests/{examinationTest}/duplicate", ['as' => 'examinationTests.duplicate', 'uses' => 'ExaminationTestController@duplicate']);
Route::resource("examinationTests","ExaminationTestController");
Route::get("examinationTracks/{examinationTrack}/duplicate", ['as' => 'examinationTracks.duplicate', 'uses' => 'ExaminationTrackController@duplicate']);
Route::resource("examinationTracks","ExaminationTrackController");
Route::get("serviceOrderFiles/{serviceOrderFile}/duplicate", ['as' => 'serviceOrderFiles.duplicate', 'uses' => 'ServiceOrderFileController@duplicate']);
Route::resource("serviceOrderFiles","ServiceOrderFileController");
Route::get("cities/{city}/duplicate", ['as' => 'cities.duplicate', 'uses' => 'CityController@duplicate']);
Route::resource("cities","CityController");
Route::get("regions/{region}/duplicate", ['as' => 'regions.duplicate', 'uses' => 'RegionController@duplicate']);
Route::resource("regions","RegionController");
Route::get("counties/{county}/duplicate", ['as' => 'counties.duplicate', 'uses' => 'CountyController@duplicate']);
Route::resource("counties","CountyController");
Route::get("customerRates/{customerRate}/duplicate", ['as' => 'customerRates.duplicate', 'uses' => 'CustomerRateController@duplicate']);
Route::resource("customerRates","CustomerRateController");
Route::get("books/{book}/duplicate", ['as' => 'books.duplicate', 'uses' => 'BookController@duplicate']);
Route::resource("books","BookController");
Route::get("authors/{author}/duplicate", ['as' => 'authors.duplicate', 'uses' => 'AuthorController@duplicate']);
Route::resource("authors","AuthorController");
Route::get("tags/{tag}/duplicate", ['as' => 'tags.duplicate', 'uses' => 'TagController@duplicate']);
Route::resource("tags","TagController");
Route::get("genres/{genre}/duplicate", ['as' => 'genres.duplicate', 'uses' => 'GenreController@duplicate']);
Route::resource("genres","GenreController");
Route::get("serviceOrderNotes/{serviceOrderNote}/duplicate", ['as' => 'serviceOrderNotes.duplicate', 'uses' => 'ServiceOrderNoteController@duplicate']);
Route::resource("serviceOrderNotes","ServiceOrderNoteController");
Route::get("positions/{position}/duplicate", ['as' => 'positions.duplicate', 'uses' => 'PositionController@duplicate']);
Route::resource("positions","PositionController");
Route::get("regionals/{regional}/duplicate", ['as' => 'regionals.duplicate', 'uses' => 'RegionalController@duplicate']);
Route::resource("regionals","RegionalController");


// end section


