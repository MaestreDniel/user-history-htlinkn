<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offers')->insert([
            [
                'offer_name' => 'Checkin Online',
                'description' => 'Una oferta genérica de checkin'
            ],
            [
                'offer_name' => 'Checkout Online',
                'description' => 'Una oferta genérica de checkout'
            ],
            [
                'offer_name' => 'Pagos digitales',
                'description' => 'Una oferta genérica de pagos digitales'
            ]
        ]);
    }
}
