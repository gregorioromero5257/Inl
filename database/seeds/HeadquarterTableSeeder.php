<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HeadquarterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $headquarters = [
            [
                'state_id' => 1,
                'name' => 'ags Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 2,
                'name' => 'bc Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 3,
                'name' => 'bcs Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 3,
                'name' => 'bcs Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 4,
                'name' => 'cmp Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 5,
                'name' => 'coa Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 5,
                'name' => 'coa Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 5,
                'name' => 'coa Sede 3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 6,
                'name' => 'col Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 6,
                'name' => 'col Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 7,
                'name' => 'chi Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 7,
                'name' => 'chi Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 8,
                'name' => 'chs Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 9,
                'name' => 'cmx Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 9,
                'name' => 'cmx Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 9,
                'name' => 'cmx Sede 3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 10,
                'name' => 'dgo Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 11,
                'name' => 'gro Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 12,
                'name' => 'gto Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 12,
                'name' => 'gto Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 13,
                'name' => 'hgo Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 13,
                'name' => 'hgo Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 14,
                'name' => 'jal Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 14,
                'name' => 'jal Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 15,
                'name' => 'mch Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 16,
                'name' => 'mex Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 16,
                'name' => 'mex Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 16,
                'name' => 'mex Sede 3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 17,
                'name' => 'mor Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 17,
                'name' => 'mor Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 18,
                'name' => 'nay Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 19,
                'name' => 'nl Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 20,
                'name' => 'oax Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 21,
                'name' => 'pue Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 21,
                'name' => 'pue Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 22,
                'name' => 'qr Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 23,
                'name' => 'qro Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 24,
                'name' => 'sin Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 25,
                'name' => 'slp Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 26,
                'name' => 'son Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 27,
                'name' => 'tab Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 28,
                'name' => 'tlx Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 29,
                'name' => 'tms Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 29,
                'name' => 'tms Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 29,
                'name' => 'tms Sede 3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 30,
                'name' => 'ver Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 30,
                'name' => 'ver Sede 2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 30,
                'name' => 'ver Sede 3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 31,
                'name' => 'yuc Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 32,
                'name' => 'zac Sede 1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        DB::table('headquarters')->insert($headquarters);
    }
}
