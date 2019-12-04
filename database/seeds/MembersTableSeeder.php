<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            ['name' => 'Rachel Margolis', 'avatar' => 'https://collateralmanagement.org/wp-content/uploads/2019/06/rachcolor-Custom.jpeg'],
            ['name' => 'Sebastian Larrazabal', 'avatar' => 'https://collateralmanagement.org/wp-content/uploads/2019/10/Sebastian-2.jpg'],
            ['name' => 'Cheylyn Moxey', 'avatar' => 'https://collateralmanagement.org/wp-content/uploads/2019/10/Chey.jpg'],
            ['name' => 'Vedran Svraka', 'avatar' => 'https://collateralmanagement.org/wp-content/uploads/2019/09/vedcolor.png']
        ]);
    }
}
