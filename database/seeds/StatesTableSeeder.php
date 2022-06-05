<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [
                'key' => 'ags',
                'name' => 'Aguascalientes',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'bc',
                'name' => 'Baja California',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'bcs',
                'name' => 'Baja California Sur',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'cmp',
                'name' => 'Campeche',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'key' => 'coa',
                'name' => 'Coahuila',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'col',
                'name' => 'Colima',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'chi',
                'name' => 'Chihuahua',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'chs',
                'name' => 'Chiapas',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'cmx',
                'name' => 'Ciudad de México',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'dgo',
                'name' => 'Durango',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'gro',
                'name' => 'Guerrero',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'gto',
                'name' => 'Guanajuato',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'hgo',
                'name' => 'Hidalgo',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'jal',
                'name' => 'Jalisco',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'mch',
                'name' => 'Michoacan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'mex',
                'name' => 'Estado de México',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'mor',
                'name' => 'Morelos',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'nay',
                'name' => 'Nayarit',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'nl',
                'name' => 'Nuevo León',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'oax',
                'name' => 'Oaxaca',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'pue',
                'name' => 'Puebla',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'qr',
                'name' => 'Quintana Roo',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'qro',
                'name' => 'Querétaro',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'sin',
                'name' => 'Sinaloa',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'slp',
                'name' => 'San Luis Potosí',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'son',
                'name' => 'Sonora',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'tab',
                'name' => 'Tabasco',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'tlx',
                'name' => 'Tlaxcala',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'tms',
                'name' => 'Tamaulipas',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'ver',
                'name' => 'Veracruz',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'yuc',
                'name' => 'Yucatán',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'key' => 'zac',
                'name' => 'Zacatecas',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DB::table('states')->insert($states);
    }
}
