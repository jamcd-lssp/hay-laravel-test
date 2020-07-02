<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Todo extends Model
{
    protected $primaryKey = 'name';
    protected $fillable = ['id', 'name', 'title', 'content', 'flg'];
    public static $rules = [
        'name' => 'required',
    	'title' => 'required',
    	'content' => 'required',
        'flg' => 'required',
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
