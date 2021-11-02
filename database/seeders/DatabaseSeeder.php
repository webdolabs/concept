<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call(SystemLocalesSeeder::class);
        $this->call(ShippmentAndPaymentSeeder::class);
        $this->call(UserAdminSeeder::class);
    }
}
