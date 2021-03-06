<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VariableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variables = [
            [ 
                'name' => 'Total de carpetas de investigación', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable2_2018',
                'check_slug_2018' => 'checked2_2018',
                'slug_2017' => 'variable2_2017',
                'check_slug_2017' => 'checked2_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '1',
            ],
            [ 
                'name' => 'Total de carpetas de investigación iniciadas por un informe policial sin detenido', 
                'source' => 'Fiscalía/Procuraduría' ,
                'slug_2018' => 'variable1_2018',
                'check_slug_2018' => 'checked1_2018',
                'slug_2017' => 'variable1_2017',
                'check_slug_2017' => 'checked1_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '1.1.1',
            ],
            [ 
                'name' => 'Total de carpetas de investigación iniciadas por un informe policial con detenido', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable3_2018',
                'check_slug_2018' => 'checked3_2018',
                'slug_2017' => 'variable3_2017',
                'check_slug_2017' => 'checked3_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '1.1.2',
            ],
            [ 
                'name' => 'Total de carpetas de investigación iniciadas por una denuncia o querella de víctima u ofendido ante el Agente del Ministerio Público', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable4_2018',
                'check_slug_2018' => 'checked4_2018',
                'slug_2017' => 'variable4_2017',
                'check_slug_2017' => 'checked4_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '1.1',
            ],
            [ 
                'name' => 'Total de carpetas de investigación iniciadas por otra fuente', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable5_2018',
                'check_slug_2018' => 'checked5_2018',
                'slug_2017' => 'variable5_2017',
                'check_slug_2017' => 'checked5_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '1.2',
            ],
            [ 
                'name' => 'Total de detenidos', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable7_2018',
                'check_slug_2018' => 'checked7_2018',
                'slug_2017' => 'variable7_2017',
                'check_slug_2017' => 'checked7_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '2',
            ],
            [ 
                'name' => 'Total e detenciones ratificadas por un Agente del Ministerio Público', 
                'source' => 'Poder Judicial del Estado y Fiscalía/Procuraduría',
                'slug_2018' => 'variable6_2018',
                'check_slug_2018' => 'checked6_2018',
                'slug_2017' => 'variable6_2017',
                'check_slug_2017' => 'checked6_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '2.1',
            ],
            [ 
                'name' => 'Total de audiencias de control de detención celebradas', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable9_2018',
                'check_slug_2018' => 'checked9_2018',
                'slug_2017' => 'variable9_2017',
                'check_slug_2017' => 'checked9_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '3',
            ],
            [ 
                'name' => 'Total de audiencias de control de detención celebradas en donde se dictó legal la detención', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable8_2018',
                'check_slug_2018' => 'checked8_2018',
                'slug_2017' => 'variable8_2017',
                'check_slug_2017' => 'checked8_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '3.1',
            ],
            [ 
                'name' => 'Total de carpetas de investigación determinadas con facultades para la terminación de la investigación', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable10_2018',
                'check_slug_2018' => 'checked10_2018',
                'slug_2017' => 'variable10_2017',
                'check_slug_2017' => 'checked10_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '4',
            ],
            [ 
                'name' => 'Total de carpetas de investigación determinadas en archivo temporal', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable11_2018',
                'check_slug_2018' => 'checked11_2018',
                'slug_2017' => 'variable11_2017',
                'check_slug_2017' => 'checked11_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '4.1',
            ],
            [ 
                'name' => 'Total de carpetas de investigación determinadas con abstención a investigar', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable12_2018',
                'check_slug_2018' => 'checked12_2018',
                'slug_2017' => 'variable12_2017',
                'check_slug_2017' => 'checked12_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '4.2',
            ],
            [ 
                'name' => 'Total de carpetas de investigación determinadas con no ejercicio de la acción penal', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable13_2018',
                'check_slug_2018' => 'checked13_2018',
                'slug_2017' => 'variable13_2017',
                'check_slug_2017' => 'checked13_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '4.3',
            ],
            [ 
                'name' => 'Total de carpetas de investigación determinadas con criterio de oportunidad', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable14_2018',
                'check_slug_2018' => 'checked14_2018',
                'slug_2017' => 'variable14_2017',
                'check_slug_2017' => 'checked14_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '4.4',
            ],
            [ 
                'name' => 'Total de carpetas de investigación resueltas mediante acuerdo reparatorio en investigación inicial', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable15_2018',
                'check_slug_2018' => 'checked15_2018',
                'slug_2017' => 'variable15_2017',
                'check_slug_2017' => 'checked15_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '5.1',
            ],
            [ 
                'name' => 'Total de carpetas de investigación resueltas mediante acuerdo reparatorio en investigación inicial derivados al órgano MASC', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable16_2018',
                'check_slug_2018' => 'checked16_2018',
                'slug_2017' => 'variable16_2017',
                'check_slug_2017' => 'checked16_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '5.1.1',
            ],
            [ 
                'name' => 'Total de carpetas de investigación resueltas mediante acuerdo reparatorio en investigación complementaria', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable22_2018',
                'check_slug_2018' => 'checked22_2018',
                'slug_2017' => 'variable22_2017',
                'check_slug_2017' => 'checked22_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '5.2',
            ],
            [ 
                'name' => 'Total de asuntos a los que se formuló imputación', 
                'source' => 'Poder Judicial del Estado y Fiscalía/Procuraduría',
                'slug_2018' => 'variable17_2018',
                'check_slug_2018' => 'checked17_2018',
                'slug_2017' => 'variable17_2017',
                'check_slug_2017' => 'checked17_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '6',
            ],
            [ 
                'name' => 'Total de carpetas de investigación en las cuales se  dictó auto de vinculación a proceso', 
                'source' => 'Poder Judicial del Estado y Fiscalía/Procuraduría',
                'slug_2018' => 'variable18_2018',
                'check_slug_2018' => 'checked18_2018',
                'slug_2017' => 'variable18_2017',
                'check_slug_2017' => 'checked18_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '7',
            ],
            [ 
                'name' => 'Total de imputados con medida cautelar', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable19_2018',
                'check_slug_2018' => 'checked19_2018',
                'slug_2017' => 'variable19_2017',
                'check_slug_2017' => 'checked19_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '9',
            ],
            [ 
                'name' => 'Total de imputados con prisión preventiva', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable20_2018',
                'check_slug_2018' => 'checked20_2018',
                'slug_2017' => 'variable20_2017',
                'check_slug_2017' => 'checked20_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '9.1',
            ],
            [ 
                'name' => 'Total de imputados con una medida cautelar distinta a prisión preventiva', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable21_2018',
                'check_slug_2018' => 'checked21_2018',
                'slug_2017' => 'variable21_2017',
                'check_slug_2017' => 'checked21_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '9.2',
            ],
            [ 
                'name' => 'Total de suspensiones condicionales del proceso', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable23_2018',
                'check_slug_2018' => 'checked23_2018',
                'slug_2017' => 'variable23_2017',
                'check_slug_2017' => 'checked23_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '10',
            ],
            [ 
                'name' => 'Total de procedimientos abreviados', 
                'source' => 'Fiscalía/Procuraduría',
                'slug_2018' => 'variable24_2018',
                'check_slug_2018' => 'checked24_2018',
                'slug_2017' => 'variable24_2017',
                'check_slug_2017' => 'checked24_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '11',
            ],
            [ 
                'name' => 'Delito 1', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable25_2018',
                'check_slug_2018' => 'checked25_2018',
                'slug_2017' => 'variable25_2017',
                'check_slug_2017' => 'checked25_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '11.1',
            ],
            [ 
                'name' => 'Delito 2', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable26_2018',
                'check_slug_2018' => 'checked26_2018',
                'slug_2017' => 'variable26_2017',
                'check_slug_2017' => 'checked26_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '11.2',
            ],
            [ 
                'name' => 'Delito 3 (añadir de ser necesario)', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable27_2018',
                'check_slug_2018' => 'checked27_2018',
                'slug_2017' => 'variable27_2017',
                'check_slug_2017' => 'checked27_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '11.3',
            ],
            [ 
                'name' => 'Total de acusaciones', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable28_2018',
                'check_slug_2018' => 'checked28_2018',
                'slug_2017' => 'variable28_2017',
                'check_slug_2017' => 'checked28_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '12',
            ],
            [ 
                'name' => 'Total de autos de apertura a juicio oral', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable33_2018',
                'check_slug_2018' => 'checked33_2018',
                'slug_2017' => 'variable33_2017',
                'check_slug_2017' => 'checked33_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '13',
            ],
            [ 
                'name' => 'Total de juicios orales', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable30_2018',
                'check_slug_2018' => 'checked30_2018',
                'slug_2017' => 'variable30_2017',
                'check_slug_2017' => 'checked30_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '14',
            ],
            [ 
                'name' => 'Total de juicios orales resueltos mediante sentencia absolutoria', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable29_2018',
                'check_slug_2018' => 'checked29_2018',
                'slug_2017' => 'variable29_2017',
                'check_slug_2017' => 'checked29_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '14.1',
            ],
            [ 
                'name' => 'Total de juicios orales resueltos mediante sentencia condenatoria', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable31_2018',
                'check_slug_2018' => 'checked31_2018',
                'slug_2017' => 'variable31_2017',
                'check_slug_2017' => 'checked31_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '14.2',
            ],
            [ 
                'name' => 'Total de juicios orales a los que se les dictó sobreseimiento', 
                'source' => 'Poder Judicial del Estado',
                'slug_2018' => 'variable32_2018',
                'check_slug_2018' => 'checked32_2018',
                'slug_2017' => 'variable32_2017',
                'check_slug_2017' => 'checked32_2017',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'num' => '14.3',
            ],
        ];
        DB::table('variables')->insert($variables);
    }
}
