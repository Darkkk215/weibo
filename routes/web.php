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
Route::get('/', function () {
    return view('welcome');
});
*/

/*
新版本写法
use App\Http\Controllers\StaticPagesController;
Route::get('/',[StaticPagesController::class,'home']);
//这是laravel老版本的写法  老版本不需要use
Route::get('/', 'StaticPagesController@home');
Laravel 8中必须要先引用使用到的控制器，或者在定义路由时加上控制器的命名空间
如果仍然想使用Laravel 6/7版本的路由配置方式，那么取消RouteServiceProvider.php中对$namespace的注释即可。
*/

Route::get('/', 'StaticPagesController@home');
Route::get('/help', 'StaticPagesController@help');
Route::get('/about', 'StaticPagesController@about');
