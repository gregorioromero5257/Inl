<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            StatesTableSeeder::class,
            QuantitativeSourcesTableSeeder::class,
            SociodemographicContextTableSeeder::class,
            InterpretationsTableSeeder::class,
            DecisionTableSeeder::class,
            ProblematicTableSeeder::class,
            ConclusionTableSeeder::class,
            AmbitTableSeeder::class,
            CriterionTableSeeder::class,
            SourceTableSeeder::class,
            SubsectionTableSeeder::class,
            CriterionproblematicTableSeeder::class,
            CrimeContextTableSeeder::class,
            HeadquarterTableSeeder::class,
            VariableTableSeeder::class,
            IndicatorTableSeeder::class,
            InterpretationGuideTableSeeder::class,
        ]);
    }
}
