<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IndicatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indicators = [
            [
                'name'=> 'Composición de asuntos iniciados mediante parte policial, víctima y otras fuentes',
                'desirable_range'=> '-',
                'decision_id'=> 1,
                'num'=> 1.1,
                'dividend'=> '',
                'divider'=> '',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Informe policial sin detenido',
                'desirable_range'=> 'N.A.',
                'decision_id'=> 1,
                'num'=> 1.2,
                'dividend'=> 'variable1_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Informe policial con detenido',
                'desirable_range'=> 'N.A.',
                'decision_id'=> 1,
                'num'=> 1.3,
                'dividend'=> 'variable3_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Denuncia de víctima u ofendido ante el Agente del Ministerio Público',
                'desirable_range'=> 'N.A.',
                'decision_id'=> 1,
                'num'=> 1.4,
                'dividend'=> 'variable4_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Otra fuente',
                'desirable_range'=> 'N.A.',
                'decision_id'=> 1,
                'num'=> 1.5,
                'dividend'=> 'variable5_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de puestas a disposición que fueron ratificadas entre el número total de detenidos',
                'desirable_range'=> '70%-80%',
                'decision_id'=> 2,
                'num'=> 2.1,
                'dividend'=> 'variable6_2018',
                'divider'=> 'variable7_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de audiencias de control de detención en que se dictó la legalidad de la detención entre el número de audiencias de control',
                'desirable_range'=> '80%-90%',
                'decision_id'=> 2,
                'num'=> 2.2,
                'dividend'=> 'variable8_2018',
                'divider'=> 'variable9_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de audiencia de control de detención entre número de detenidos',
                'desirable_range'=> '50%-60%',
                'decision_id'=> 3,
                'num'=> 3.1,
                'dividend'=> 'variable9_2018',
                'divider'=> 'variable7_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos resueltos mediante facultades para la terminación de la investigación entre los asuntos que ingresaron a la Fiscalía/Procuraduría',
                'desirable_range'=> '45%-50%',
                'decision_id'=> 4,
                'num'=> 4.1,
                'dividend'=> 'variable10_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos en archivo temporal entre asuntos resueltos mediante facultades para la terminación de la investigación',
                'desirable_range'=> '70%-80%',
                'decision_id'=> 4,
                'num'=> 4.2,
                'dividend'=> 'variable11_2018',
                'divider'=> 'variable10_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos con abstención a investigar entre asuntos resueltos mediante facultades para la terminación de la investigación',
                'desirable_range'=> '1%-5%',
                'decision_id'=> 4,
                'num'=> 4.3,
                'dividend'=> 'variable12_2018',
                'divider'=> 'variable10_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos con un no ejercicio de la acción penal entre asuntos resueltos mediante facultades para la terminación de la investigación',
                'desirable_range'=> '5%-10%',
                'decision_id'=> 4,
                'num'=> 4.4,
                'dividend'=> 'variable13_2018',
                'divider'=> 'variable10_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos con criterio de oportunidad entre asuntos resueltos mediante facultades para la terminación de la investigación',
                'desirable_range'=> '1%-5%',
                'decision_id'=> 4,
                'num'=> 4.5,
                'dividend'=> 'variable14_2018',
                'divider'=> 'variable10_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'N.A.',
                'desirable_range'=> '-',
                'decision_id'=> 5,
                'num'=> 5.1,
                'dividend'=> '',
                'divider'=> '',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos en que se celebró un acuerdo reparatorio en investigación inicial entre las denuncias recibidas',
                'desirable_range'=> '10%-15%',
                'decision_id'=> 6,
                'num'=> 6.1,
                'dividend'=> 'variable15_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos derivados al órgano MASC entre los asuntos en que se celebró un acuerdo reparatorio en la investigación inicial',
                'desirable_range'=> '80%-90%',
                'decision_id'=> 6,
                'num'=> 6.2,
                'dividend'=> 'variable16_2018',
                'divider'=> 'variable15_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos en que se realizó la formulación de imputación entre denuncias recibidas',
                'desirable_range'=> '20%-25%',
                'decision_id'=> 7,
                'num'=> 7.1,
                'dividend'=> 'variable17_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos a los que se dictó auto de vinculación a proceso entre los asuntos a los que se formuló imputación',
                'desirable_range'=> '80%-90%',
                'decision_id'=> 7,
                'num'=> 7.2,
                'dividend'=> 'variable18_2018',
                'divider'=> 'variable17_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos a los que se les dictó una medida cautelar entre los asuntos vinculados a proceso',
                'desirable_range'=> '90%-95%',
                'decision_id'=> 8,
                'num'=> 8.1,
                'dividend'=> 'variable19_2018',
                'divider'=> 'variable18_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos resueltos mediante prisión preventiva entre el total de asuntos a los que se les dictó medida cautelar',
                'desirable_range'=> '20%-30%',
                'decision_id'=> 8,
                'num'=> 8.2,
                'dividend'=> 'variable20_2018',
                'divider'=> 'variable19_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos resueltos con una medida cautelar diferente a prisión preventiva entre el total de asuntos a los que se les dictó medida cautelar',
                'desirable_range'=> '60%-70%',
                'decision_id'=> 8,
                'num'=> 8.3,
                'dividend'=> 'variable21_2018',
                'divider'=> 'variable19_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos en los que se celebró un acuerdo reparatorio en la investigación complementaria entre denuncias recibidas',
                'desirable_range'=> '1%-5%',
                'decision_id'=> 9,
                'num'=> 9.1,
                'dividend'=> 'variable22_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos en los que se celebró una suspensión condicional del proceso entre denuncias recibidas',
                'desirable_range'=> '10%-15%',
                'decision_id'=> 10,
                'num'=> 10.1,
                'dividend'=> 'variable23_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos a los que se les dictó un procedimiento abreviado entre denuncias recibidas',
                'desirable_range'=> '2%-4%',
                'decision_id'=> 11,
                'num'=> 11.1,
                'dividend'=> 'variable24_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Composición de delitos que se resolvieron mediante un procedimiento abreviado por tipo de delito',
                'desirable_range'=> '-',
                'decision_id'=> 11,
                'num'=> 11.2,
                'dividend'=> '',
                'divider'=> '',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Delito 1',
                'desirable_range'=> 'N.A.',
                'decision_id'=> 11,
                'num'=> 11.3,
                'dividend'=> 'variable25_2018',
                'divider'=> 'variable24_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Delito 2',
                'desirable_range'=> 'N.A.',
                'decision_id'=> 11,
                'num'=> 11.4,
                'dividend'=> 'variable26_2018',
                'divider'=> 'variable24_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Delito 3 (Añadir de ser necesario)',
                'desirable_range'=> 'N.A.',
                'decision_id'=> 11,
                'num'=> 11.5,
                'dividend'=> 'variable27_2018',
                'divider'=> 'variable24_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Tasa de asuntos en los que se presentó la acusación entre asuntos vinculados a proceso',
                'desirable_range'=> '10%-15%',
                'decision_id'=> 12,
                'num'=> 12.1,
                'dividend'=> 'variable28_2018',
                'divider'=> 'variable18_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Tasa de asuntos en los que se presentó la acusación entre denuncias recibidas',
                'desirable_range'=> '-',
                'decision_id'=> 12,
                'num'=> 12.2,
                'dividend'=> 'variable28_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Tasa de asuntos a los que se les dictó auto de apertura a juicio oral entre asuntos vinculados a proceso',
                'desirable_range'=> '-',
                'decision_id'=> 12,
                'num'=> 12.3,
                'dividend'=> 'variable33_2018',
                'divider'=> 'variable18_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Tasa de asuntos a los que se les dictó auto de apertura a juicio oral entre denuncias recibidas',
                'desirable_range'=> '-',
                'decision_id'=> 12,
                'num'=> 12.4,
                'dividend'=> 'variable33_2018',
                'divider'=> 'variable2_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Composición de sentencias absolutorias, condenatorias y sobreseimiento entre asuntos resueltos en juicio oral',
                'desirable_range'=> '-',
                'decision_id'=> 13,
                'num'=> 13.1,
                'dividend'=> '',
                'divider'=> '',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Sentencias absolutorias',
                'desirable_range'=> 'N.A.',
                'decision_id'=> 13,
                'num'=> 13.2,
                'dividend'=> 'variable29_2018',
                'divider'=> 'variable30_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Sentencias condenatorias',
                'desirable_range'=> 'N.A.',
                'decision_id'=> 13,
                'num'=> 13.3,
                'dividend'=> 'variable31_2018',
                'divider'=> 'variable30_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'Sobreseimientos',
                'desirable_range'=> 'N.A.',
                'decision_id'=> 13,
                'num'=> 13.4,
                'dividend'=> 'variable32_2018',
                'divider'=> 'variable30_2018',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DB::table('indicators')->insert($indicators);
    }
}
