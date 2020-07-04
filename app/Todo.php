<?php

namespace App;

use App\Usser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Todo extends Model
{
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
