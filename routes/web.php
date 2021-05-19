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
Route::prefix('api')->group(function () {
    Route::get('/categories', 'App\Http\Controllers\Admin\CategoryController@apiIndex');
    Route::post('/categories/attribute', 'App\Http\Controllers\Admin\CategoryController@apiIndexAttribute');
});
Route::group(['middleware'=>'auth'],function (){
    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('admin.dashboard');
    Route::get('attributes.delete/{id}','App\Http\Controllers\Admin\AttributeGroupController@delete')->name('attributes.delete');
    Route::resource('attributes','App\Http\Controllers\Admin\AttributeGroupController');
    Route::get('attributes-value.delete/{id}','App\Http\Controllers\Admin\AttributeValueController@delete')->name('attributes-value.delete');
    Route::resource('attributes-value','App\Http\Controllers\Admin\AttributeValueController');
    Route::get('categories.delete/{id}','App\Http\Controllers\Admin\CategoryController@delete')->name('categories.delete');
    Route::get('categories.indexSetting/{id}','App\Http\Controllers\Admin\CategoryController@indexSetting')->name('categories.indexSetting');
    Route::post('categories.saveSetting/{id}','App\Http\Controllers\Admin\CategoryController@saveSetting');
    Route::resource('categories','App\Http\Controllers\Admin\CategoryController');
    Route::get('brands.delete/{id}','App\Http\Controllers\Admin\BrandController@delete')->name('brands.delete');
    Route::resource('brands','App\Http\Controllers\Admin\BrandController');
    Route::post('photos/upload','App\Http\Controllers\Admin\PhotoController@uploads')->name('photos.upload');
    Route::post('videos/upload','App\Http\Controllers\Admin\VideoController@uploads')->name('videos.upload');
    Route::get('products.delete/{id}','App\Http\Controllers\Admin\ProductController@delete')->name('products.delete');
    Route::resource('products','App\Http\Controllers\Admin\ProductController');
    Route::get('brands.indexSetting/{id}','App\Http\Controllers\Admin\BrandController@indexSetting')->name('brands.indexSetting');
    Route::post('brands.saveSetting/{id}','App\Http\Controllers\Admin\BrandController@saveSetting');
    Route::get('slides.delete/{id}','App\Http\Controllers\Admin\SlideController@delete')->name('slides.delete');
    Route::get('slides/publish/{id}/{status}','App\Http\Controllers\Admin\SlideController@publish')->name('slides.publish');
    Route::resource('slides','App\Http\Controllers\Admin\SlideController');
});

Auth::routes();

Route::resource('/homedesk','App\Http\Controllers\Frontend\HomeController');
Route::get('product/single/{id}','Frontend\ProductController@getProduct')->name('products.single');
Route::get('category/single/{id}','Frontend\ProductController@categoryProduct')->name('category.single');
Route::get('category/{id}','Frontend\ProductController@getProductByCategory')->name('category.index');
Route::prefix('api')->group(function () {
    Route::get('/products/{id}','Frontend\ProductController@apiGetProduct');
    Route::get('/sort-products/{id}/{sort}/{paginate}','Frontend\ProductController@apiGetSortedProduct');
    Route::get('/category-attribute/{id}','Frontend\ProductController@apiGetCategoryAttributes');
    Route::get('/filter-products/{id}/{sort}/{paginate}/{attributes}','Frontend\ProductController@apiGetFilterProducts');
});
