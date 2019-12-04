<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            ['name' => 'Done'],
            ['name' => 'Working On it'],
            ['name' => 'Stuck'],
            ['name' => 'Not Started']
           ]);
    }
}
