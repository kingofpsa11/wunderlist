<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListTask extends Model
{
    protected $fillable = ['id', 'title'];

    public $timestamp = true;

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
