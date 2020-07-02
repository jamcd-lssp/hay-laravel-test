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
        	'user_name' => 'test',
        	'title' => 'やりたいことを入力するとここに表示されます！',
        	'content' => 'やり終えたら終了を押してね。',
        	'flg' => 1,
		];
		DB::table('todos')->insert($param);

		$param = [
        	'user_name' => 'hay',
        	'title' => '早起き',
        	'content' => '朝活！',
        	'flg' => 0,
		];
		DB::table('todos')->insert($param);
    }
}
