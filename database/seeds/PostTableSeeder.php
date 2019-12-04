<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            ['title' => 'hello', 'member_id' => '1', 'status_id' => '2', 'timeline' => '20%', 'time' => '2 days'],
            ['title' => 'asdfasdfasdf', 'member_id' => '2', 'status_id' => '1', 'timeline' => '70%', 'time' => '5 days']
        ]);
    }
}
