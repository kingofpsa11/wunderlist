<?php
use App\Models\ListTask;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('sidebar', function () {
    return view('sidebar', ['name' => 'Ha Pham', 'result' => 'success']);
});

Route::resource('list', 'ListTaskController');

Route::resource('task', 'TaskController');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('modal/{name}', function ($name) {
    if ($name == 'addList') {
        return view('components.modals.createlist');
    } elseif ($name == 'accountSettings') {
        return view('components.modals.usersetting');
    }
});

