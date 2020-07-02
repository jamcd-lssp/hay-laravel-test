<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Todo extends Model
{
    protected $primaryKey = 'user_name';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['user_name', 'title', 'content', 'flg'];
    public static $rules = [
        'user_name' => 'required',
    	'title' => 'required',
    	'content' => 'required',
    ];

    public function scopeFlg($query, $num)
    {
    	return $query->where('flg', $num);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
