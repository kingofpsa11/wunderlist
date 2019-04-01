<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListTask extends Model
{
    protected $fillable = ['id', 'title', 'user_id'];

    public $timestamps = true;

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    
}
