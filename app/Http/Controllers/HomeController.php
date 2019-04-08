<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListTask;
use App\Models\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $tasks = Task::where('list_task_id', 1)->get();
        $lists = ListTask::where('id', '>', 1)->get();
        return view('index')->with(['lists' => $lists, 'tasks' => $tasks]);
    }
}
