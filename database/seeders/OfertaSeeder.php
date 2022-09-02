<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ofertas')->insert([
            [
                'nombre_oferta' => 'Checkin Online',
                'descripcion' => 'Una oferta genérica de checkin'
            ],
            [
                'nombre_oferta' => 'Checkout Online',
                'descripcion' => 'Una oferta genérica de checkout'
            ],
            [
                'nombre_oferta' => 'Pagos digitales',
                'descripcion' => 'Una oferta genérica de pagos digitales'
            ]
        ]);
    }
}
