<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['id', 'title', 'duedate', 'reminder_date', 'status', 'list_task_id'];

    public $timestamps = true;

    protected $attributes = [
        'status' => 1
    ];

    public function list_tasks()
    {
        return $this->belongsTo('App\Models\ListTask');
    }

    public function subtasks()
    {
        return $this->hasMany('App\Models\Subtask');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    public function note()
    {
        return $this->hasOne('App\Models\Note');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }
}
