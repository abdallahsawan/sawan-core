<?php

Route::post('upload', 'Lara\Core\Controllers\AttachmentController@upload');
Route::get('download/{id}', 'Lara\Core\Controllers\AttachmentController@download');
