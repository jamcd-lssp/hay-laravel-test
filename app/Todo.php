<?php

namespace App;

use App\Usser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Todo extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = ['title', 'content', 'flg'];
    public static $rules = [
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
        return $this->belongsTo(User::class);
    }
}
