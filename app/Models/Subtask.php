<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    protected $fillable = ['title','id','status','task_id'];

    public $timestamps = true;

    protected $attributes = [
        'status' => 1
    ];

    public function tasks()
    {
        return $this->belongsTo('App\Models\Task');
    }

}
