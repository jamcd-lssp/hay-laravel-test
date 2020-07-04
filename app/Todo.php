<?php

namespace App;

use App\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Todo extends Model
{
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
