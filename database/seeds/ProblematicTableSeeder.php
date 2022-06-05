<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProblematicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $problematics = [
            [
                'state_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 9,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 11,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 12,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 13,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 14,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 15,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 16,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 17,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 18,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 19,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 20,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 21,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 22,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 23,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 24,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 25,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 26,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 27,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 28,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 29,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 30,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 31,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'state_id' => 32,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        DB::table('problematics')->insert($problematics);
    }
}
