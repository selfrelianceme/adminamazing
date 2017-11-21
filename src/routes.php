<?php

Route::group(['prefix' => config('adminamazing.path'), 'middleware' => ['web','CheckAccess']], function() {
    Route::get('/', 'selfreliance\adminamazing\AdminController@index')->name('AdminMain');
    Route::get('/blocks', 'selfreliance\adminamazing\AdminController@blocks')->name('AdminBlocks');
    Route::post('/add_blocks', 'selfreliance\adminamazing\AdminController@addBlocks')->name('AdminBlocksAdd');
    Route::put('/update_blocks', 'selfreliance\adminamazing\AdminController@updateBlocks')->name('AdminBlockUpdate');
    Route::delete('/{id}', 'selfreliance\adminamazing\AdminController@deleteBlock')->name('AdminBlockDelete');
});