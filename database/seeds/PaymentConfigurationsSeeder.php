<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PaymentConfigurationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('payment_configurations')->insert([
            'status' => false,
            'test_username' => 'mem',
            'test_pass' => '123',
          ]);
    }
}
