<?php

Route::get('/', function () {
    if(Auth::guest())
        return view('auth.login');
    return redirect('dashboard');
})->name('admin.dashboard');
//Route::get('/login','LoginController@login');
Route::get('/dashboard','DashboardController@index')->name('dashboard');

Route::group(['prefix' => 'cua-hang'], function () {
Route::get('/', 'StoreController@index')->name('Store.index');
Route::get('create', 'StoreController@create')->name('Store.create');
Route::post('created', 'StoreController@created')->name('Store.created');
//    Route::get('info', 'StoreController@info')->name('Store.info');
Route::get('/edit/{id}', 'StoreController@edit')->name('Store.edit');
Route::get('/update/{id}', 'StoreController@update')->name('Store.update');
Route::post('/update/{id}', 'StoreController@update')->name('Store.update');
Route::get('destroy/{id}', 'StoreController@destroy')->name('Store.destroy');


Route::get('product/{id_store}', 'StoreController@product_store')->name('Store.product');
Route::get('order/{id_store}', 'StoreController@order_store')->name('Store.order');

});


Route::group(['prefix'=>'doanh-so'],function (){
Route::get('/', 'DoanhSoController@index')->name('doanhso.index');

});
Route::group(['prefix'=>'danh-muc'],function (){
Route::get('/', 'DanhMucController@index')->name('danhmuc.index');
Route::get('/create', 'DanhMucController@create')->name('danhmuc.create');
Route::post('/created', 'DanhMucController@created')->name('danhmuc.created');
Route::get('/edit/{id}', 'DanhMucController@edit')->name('danhmuc.edit');
Route::post('/update/{id}', 'DanhMucController@update')->name('danhmuc.update');
Route::get('/destroy/{id}', 'DanhMucController@destroy')->name('danhmuc.destroy');

});

Route::group(['prefix'=>'comment'],function (){
Route::get('/', 'SanPhamController@comment')->name('comment.index');
Route::get('reply/{comment_id}', 'SanPhamController@reply_comment')->name('comment.reply');

});
//
//Route::group(['prefix'=>'don-hang'],function (){
//Route::get('/', 'OrdersController@index')->name('donhang.index');
////Route::get('reply/{comment_id}', 'SanPhamController@reply_comment')->name('comment.reply');
//
//});

Route::group(['prefix' => 'don-hang'], function () {

Route::get('/', 'OrdersController@index')->name('donhang.index');

Route::get('xemchitietdh/{id}', 'OrdersController@xemchitietdh')->name('donhang.xemchitietdh');

Route::get('duyetdh/{id}', 'OrdersController@duyetdh')->name('donhang.duyetdh');

Route::get('huydh/{id}', 'OrdersController@huydh')->name('donhang.huydh');

Route::get('sales-history', 'OrdersController@saleshistory')->name('donhang.saleshistory');


});
Route::group(['prefix' => 'san-pham'], function () {

Route::get('/', 'SanPhamController@index')->name('sanpham.index');

Route::get('create', 'SanPhamController@create')->name('sanpham.create');

Route::post('created', 'SanPhamController@created')->name('sanpham.created');

Route::get('destroy/{id}', 'SanPhamController@destroy')->name('sanpham.destroy');

Route::get('edit/{id}', 'SanPhamController@edit')->name('sanpham.edit');

Route::post('update/{id}', 'SanPhamController@update')->name('sanpham.update');

Route::get('comment/{id}', 'SanPhamController@product_comment')->name('sanpham.comment');

Route::post('/search', 'SanPhamController@search')->name('sanpham.search');

Route::post('/search-comment', 'SanPhamController@search_comment')->name('sanpham.search-comment');

Route::get('printQRcode', 'SanPhamController@printQRcode')->name('sanpham.printQRcode');

});
Auth::routes();
Route::get('/home',function(){
    return redirect('/');
});
Route::get('/admin/logout', 'Auth\LoginController@logout')->name('logout');
