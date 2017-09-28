<?php

Route::group(['prefix' => config('adminamazing.path'), 'middleware' => 'web'], function() {
    Route::get('/', 'selfreliance\adminamazing\AdminController@index')->name('AdminMain');
});
