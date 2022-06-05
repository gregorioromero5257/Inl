<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DecisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $decisions = [
            [
                'num' => 1,
                'name' => 'Iniciar la investigación',
                'collapsed' => 0,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 2,
                'name' => 'Ratificar detenciones en flagrancia',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 3,
                'name' => 'Ordenar la libertad de la persona detenida en flagrancia',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 4,
                'name' => 'Usar facultades para la terminación de la investigación',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 5,
                'name' => 'Dirigir la investigación',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 6,
                'name' => 'Resolver casos mediante acuerdo reparatorio en la investigación inicial',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 7,
                'name' => 'Solicitar audiencia inicial',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 8,
                'name' => 'Solicitar medidas cautelares',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 9,
                'name' => 'Resolver casos mediante acuerdo reparatorio en la investigación complementaria',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 10,
                'name' => 'Resolver casos mediante suspensión condicional del proceso',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 11,
                'name' => 'Resolver casos mediante procedimiento abreviado',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 12,
                'name' => 'Presentar la acusación',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'num' => 13,
                'name' => 'Preparar la audiencia de juicio oral',
                'collapsed' => 1,
                'observations_collapsed' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        DB::table('decisions')->insert($decisions);
    }
}
