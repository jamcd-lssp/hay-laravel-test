<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Todo extends Model
{
    protected $primaryKey = 'name';
    protected $fillable = ['name', 'title', 'content', 'flg'];
    public static $rules = [
    	'title' => 'required',
    	'content' => 'required',
    ];

    public function scopeFlg($query, $num)
    {
    	return $query->where('flg', $num);
    }

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
}
