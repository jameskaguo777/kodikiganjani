<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegisterNewBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('register_new_businesses')->insert([
            'id' => 1
        ]);
    }
}
