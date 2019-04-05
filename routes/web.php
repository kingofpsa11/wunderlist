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

Route::get('tasks/{list_id}', function ($list_id) {
    $tasks = Task::where('list_task_id', $list_id)->get();
    return $tasks->toJson();
});

Route::resource('task', 'TaskController');

Route::get('subtask/{task_id}', 'SubtaskController@index');
Route::resource('subtask', 'SubtaskController');

Route::get('comment/{task_id}', 'CommentController@index');
Route::resource('comment', 'CommentController');
Auth::routes();

Route::get('user', function () {
    return Auth::user()->name;
});
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('modal/{name}', function ($name) {
    if ($name == 'addList') {
        return view('components.modals.createlist');
    } elseif ($name == 'accountSettings') {
        return view('components.modals.usersetting');
    }
});

Route::get('taskItem/{id}', function ($id) {
    $task = App\Models\Task::find($id);
    return view('components.tasks.task')->with('task', $task);
});

Route::get('taskItemCompleted/{id}', function ($id) {
    $task = App\Models\Task::find($id);
    return view('components.tasks.completedtask')->with('task', $task);
});

