<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach('tasks')->insert([
        	'foldr_id' => 1,
        	'title' => 'サンプルタスク{$num}',
        	'status' => $num,
        	'due_date' => Carbon::now()->addDay($num),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
    }
}
