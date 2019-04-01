<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['id', 'title', 'duedate', 'reminder_date', 'status', 'list_task_id'];

    public $timestamps = true;

    public function list_tasks()
    {
        return $this->belongsTo('App\Models\ListTask');
    }
}
