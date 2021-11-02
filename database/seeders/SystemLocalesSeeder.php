<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemLocalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_locales')->insert([
            [
                'name' => 'cs',
                'label' => 'Česká Republika',
                'lang' => 'czech',
                'lang_label' => 'Čeština',
                'currency_label' => 'CZK',
                'currency_symbol' => 'Kč',
                'default' => 1,
                'active' => 1
            ]
        ]);

        DB::table('system_locales')->insert([
            [
                'name' => 'sk',
                'label' => 'Slovensko',
                'lang' => 'slovak',
                'lang_label' => 'Slovenčina',
                'currency_label' => 'EUR',
                'currency_symbol' => '€',
                'default' => 0,
                'active' => 0
            ]
        ]);
    }
}
