<?php

namespace App\Http\Controllers;

use App\Models\ListTask;
use Illuminate\Http\Request;

class ListTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $listTask = new ListTask();
        $listTask->title = $request->title;
        $listTask->user_id = 1;
        $listTask->save();
        return view('components.navigation.sidebar.sidebaritem')->with('list', $listTask);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ListTask  $listTask
     * @return \Illuminate\Http\Response
     */
    public function show(ListTask $listTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ListTask  $listTask
     * @return \Illuminate\Http\Response
     */
    public function edit(ListTask $listTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListTask  $listTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListTask $listTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListTask  $listTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListTask $listTask)
    {
        //
    }
}
