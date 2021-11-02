<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippmentAndPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('e_shippings')->insert([
            [
                'name' => 'zasilkovna',
                'label' => 'Zásilkovna',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'ceska_posta',
                'label' => 'Česká pošta - do ruky',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'zasilkovna_na_adresu',
                'label' => 'Zásilkovna - doručení na adresu',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'ceska_posta_balikovna',
                'label' => 'Balíkovna',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'ceska_posta_na_postu',
                'label' => 'Česká pošta - na poštu',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'dpd_pickup',
                'label' => 'DPD Pickup',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'geis_point',
                'label' => 'Geis Point',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'gls_parcelshop',
                'label' => 'GLS Parcelshop',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'ppl_parcelshop',
                'label' => 'PPL Parcelshop',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'toptrans_depo',
                'label' => 'Toptrans Depo',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'wedo_ulozenka',
                'label' => 'WE|DO Uloženka',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_shippings')->insert([
            [
                'name' => 'dpd',
                'label' => 'DPD',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_payments')->insert([
            [
                'name' => 'on-delivery',
                'label' => 'Dobírka',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_payments')->insert([
            [
                'name' => 'banktransfer',
                'label' => 'Bankovní převod',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);

        DB::table('e_payments')->insert([
            [
                'name' => 'gopay-platba-kartou',
                'label' => 'Platba kartou',
                'price' => 0,
                'price_VAT' => 0,
                'active' => 0,
                'locale' => 'cs',
            ]
        ]);
    }
}
