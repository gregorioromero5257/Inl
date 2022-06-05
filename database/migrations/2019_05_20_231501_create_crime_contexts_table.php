<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrimeContextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crime_contexts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->nullable();
            
            $table->float('variable1',30,10)->nullable();
            $table->float('variable2',30,10)->nullable();
            $table->float('variable3',30,10)->nullable();
            $table->float('variable4',30,10)->nullable();
            $table->float('variable5',30,10)->nullable();
            $table->float('variable6',30,10)->nullable();
            $table->float('variable7',30,10)->nullable();
            $table->float('variable8',30,10)->nullable();
            $table->float('variable9',30,10)->nullable();
            $table->float('variable10',30,10)->nullable();
            $table->float('variable11',30,10)->nullable();
            $table->float('variable12',30,10)->nullable();
            $table->float('variable13',30,10)->nullable();
            $table->float('variable14',30,10)->nullable();
            $table->float('variable15',30,10)->nullable();
            $table->float('variable16',30,10)->nullable();
            $table->float('variable17',30,10)->nullable();
            $table->float('variable18',30,10)->nullable();
            $table->float('variable19',30,10)->nullable();

            $table->integer('clasification1')->nullable();
            $table->integer('clasification2')->nullable();
            $table->integer('clasification3')->nullable();
            $table->integer('clasification4')->nullable();
            $table->integer('clasification5')->nullable();
            $table->integer('clasification6')->nullable();
            $table->integer('clasification7')->nullable();
            $table->integer('clasification8')->nullable();
            $table->integer('clasification9')->nullable();
            $table->integer('clasification10')->nullable();
            $table->integer('clasification11')->nullable();
            $table->integer('clasification12')->nullable();
            $table->integer('clasification13')->nullable();
            $table->integer('clasification14')->nullable();
            $table->integer('clasification15')->nullable();
            $table->integer('clasification16')->nullable();
            $table->integer('clasification17')->nullable();
            $table->integer('clasification18')->nullable();
            $table->integer('clasification19')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crime_contexts');
    }
}
