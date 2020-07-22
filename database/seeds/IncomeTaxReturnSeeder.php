<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class IncomeTaxReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('income_tax_returns')->insert([
            'id' => 1
        ]);
    }
}
