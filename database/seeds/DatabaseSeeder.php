<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(IncomeTaxReturnSeeder::class);
        $this->call(RegisterNewBusinessSeeder::class);
        $this->call(PaymentConfigurationsSeeder::class);
        $this->call(AboutInfoSeeder::class);
        $this->call(PermissionsDataSeeder::class);
    }
}
