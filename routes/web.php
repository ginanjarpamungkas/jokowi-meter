<?php
Route::get('/', function () {
    return view('index');
});
Route::get('/beta', 'FrontController@getData')->name('front.index');
Route::post('/loadmore', 'FrontController@getDatas')->name('loadmore');
Route::get('/search', 'FrontController@getSearch')->name('search');
Route::get('/status/janji/{slug}', 'FrontController@getStatus')->name('status');
Route::get('/detail/{slug}', 'FrontController@detail')->name('front.detail');
Route::get('/filter', 'FrontController@getFilter')->name('filter');
Route::post('/sendemail', 'MailController@sendemail')->name('sendemail');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/about', function () {
    return view('frontend.tentang');
})->name('tentang');

Route::get('/metodologi', function () {
    return view('frontend.metodologi');
})->name('metodologi');

Auth::routes();
Route::group(['middleware' => 'auth'],function(){
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('/home','PromisesController@index')->name('jm.index');
    Route::get('/jokowimeter','PromisesController@index')->name('jm.index');
    Route::get('/promises/list','PromisesController@getData')->name('promises.list');
    Route::get('/promises/create','PromisesController@create')->name('promises.create');
    Route::post('/promises/store','PromisesController@store')->name('promises.store');
    Route::post('/promises/edit/{id}','PromisesController@edit');
    Route::post('/promises/save','PromisesController@update')->name('promises.update');
    Route::get('/promises/show/{slug}','PromisesController@show')->name('promises.show');
    Route::get('/promises/deletePromises/{id}','PromisesController@destroy');
    Route::post('/detail/save','PromisesController@saveDetail')->name('detail.save');
    Route::post('/detail/edit/{id}','PromisesController@editDetail');
    Route::post('/detail/update','PromisesController@updateDetail')->name('detail.update');
    Route::get('/detail/delete/{id}','PromisesController@deleteDetail')->name('detail.delete');
    
    Route::get('/artikel/list','ArtikelController@getData')->name('artikel.list');
    Route::get('/artikel/create','ArtikelController@create')->name('artikel.create');
    Route::post('/artikel/store','ArtikelController@store')->name('artikel.store');
    Route::get('/artikel/edit/{slug}','ArtikelController@edit')->name('artikel.edit');
    Route::post('/artikel/save/{id}','ArtikelController@update')->name('artikel.update');
    Route::get('/artikel/show/{slug}','ArtikelController@show')->name('artikel.show');
    Route::get('/artikel/deleteArtikel/{id}','ArtikelController@destroy');
    
    Route::get('/user/list','UserController@getData')->name('user.list');
    Route::post('/user/store','UserController@store')->name('user.store');
    Route::get('/deleteUsers/{id}','UserController@destroy');
    Route::post('/user/save','UserController@update')->name('users.update');
    
    Route::get('/periode/create','MasterController@periode')->name('master.periode');
    Route::get('/status/create','MasterController@status')->name('master.status');
    Route::get('/topik/create','MasterController@topik')->name('master.topik');
    Route::post('periode','MasterController@periodeStore');
    Route::delete('/deletePeriode/{id}','MasterController@deletePeriode')->name('periode.delete');
    Route::post('Status','MasterController@statusStore');
    Route::delete('/deleteStatus/{id}','MasterController@deleteStatus')->name('status.delete');
    Route::post('Topik','MasterController@topikStore');
    Route::delete('/deleteTopik/{id}','MasterController@deleteTopik')->name('topik.delete');
});
