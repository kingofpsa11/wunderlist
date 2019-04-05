<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['id', 'content', 'task_id'];

    public $timestamps = true;

    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }
}
