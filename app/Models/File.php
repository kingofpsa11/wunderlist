<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['id' , 'file', 'task_id'];

    public $timestamps = true;

    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }
}
