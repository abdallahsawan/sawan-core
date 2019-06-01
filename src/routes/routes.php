<?php
Route::prefix('api')->group(function () {
    Route::post('upload', 'Sawan\Core\Controllers\AttachmentController@upload');
    Route::get('download/{id}', 'Sawan\Core\Controllers\AttachmentController@download');
});
