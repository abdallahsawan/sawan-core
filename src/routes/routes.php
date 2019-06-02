<?php
Route::prefix('api')->group(function () {
    Route::post('upload', 'Sawan\Core\Controllers\AttachmentController@upload');
    Route::post('upload-all', 'Sawan\Core\Controllers\AttachmentController@uploadAll');
    Route::get('download/{id}', 'Sawan\Core\Controllers\AttachmentController@download');
});
Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'Sawan\Core\Controllers\PageController@home')->name('home');
    Route::get('/home', 'Sawan\Core\Controllers\PageController@home')->name('home');
    Route::resource('parameters', 'Sawan\Core\Controllers\ParameterController');
});
/*Route::middleware('auth')->get('/', function () {
    return view('home');
});
Route::middleware('auth')->get('/', function () {
    return view('home');
});*/
/*Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'Sawan\Core\Controllers\PageController@home')->name('home');
    Route::get('/home', 'Sawan\Core\Controllers\PageController@home')->name('home');
});
*/
