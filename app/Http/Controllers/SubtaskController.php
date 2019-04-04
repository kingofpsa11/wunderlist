<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($task_id)
    {
        $subtasks = Subtask::where('task_id', $task_id)->get();
        return $subtasks->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subtask = new Subtask();
        $subtask->title = $request->title;
        $subtask->task_id = $request->taskItem_id;
        $subtask->save();
        return $subtask->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function show(Subtask $subtask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function edit(Subtask $subtask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subtask $subtask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtask $subtask)
    {
        //
    }
}
