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

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UserController@create')->name('signup');

Route::resource('users', 'UserController');
/*
上面代码将等同于
Route::get('/users', 'userController@index')->name('users.index');
Route::get('/users/create', 'userController@create')->name('users.create');
Route::get('/users/{user}', 'userController@show')->name('users.show');
Route::post('/users', 'userController@store')->name('users.store');
Route::get('/users/{user}/edit', 'userController@edit')->name('users.edit');
Route::patch('/users/{user}', 'userController@update')->name('users.update');
Route::delete('/users/{user}', 'userController@destroy')->name('users.destroy');
*/
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');
