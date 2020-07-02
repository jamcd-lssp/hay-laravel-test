<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
        	'user-name' => 'hon',
        	'title' => 'TodoListの作成',
        	'content' => '今日中には作成したい。',
        	'flg' => 1,
		];
		DB::table('todos')->insert($param);
    }
}
