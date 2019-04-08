<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($task_id)
    {
        $files = File::where('task_id', $task_id)->get();
        $view = '';
        foreach ($files as $file) {
            $extension = explode('.', $file->file);
            $file->extension = $extension[1];
            $name = explode('/', $file->file);
            $file->name = $name[1];
            $view .= view('components.detail.file')->with(['file' => $file]);
        }
        return $view;
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
        $file = new File();
        $file->task_id = $request->input('task_id');
        $fileItem = $request->file('file');
        $fileTarget = $fileItem->getClientOriginalName();
        $file->file = $fileItem->storeAs('public', $fileTarget);
        $file->save();
        $file->extension = $fileItem->getClientOriginalExtension();
        $file->name = $fileTarget;
        return view('components.detail.file')->with('file', $file);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        $file->extension = 'png';
        return $file->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
