<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['id', 'content', 'task_id'];

    public $timestamps = true;

    public function tasks()
    {
        return $this->belongsTo('App\Modes\Task');
    }
}
