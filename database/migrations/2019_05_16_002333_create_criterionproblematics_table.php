<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriterionproblematicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterionproblematics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->nullable();
            $table->text('problematicbycriterion1')->nullable();
            $table->text('problematicbycriterion2')->nullable();
            $table->text('problematicbycriterion3')->nullable();
            $table->text('problematicbycriterion4')->nullable();
            $table->text('problematicbycriterion5')->nullable();
            $table->text('problematicbycriterion6')->nullable();
            $table->text('problematicbycriterion7')->nullable();
            $table->text('problematicbycriterion8')->nullable();
            $table->text('problematicbycriterion9')->nullable();
            $table->text('problematicbycriterion10')->nullable();
            $table->text('problematicbycriterion11')->nullable();
            $table->text('problematicbycriterion12')->nullable();
            $table->text('problematicbycriterion13')->nullable();
            $table->text('problematicbycriterion14')->nullable();
            $table->text('problematicbycriterion15')->nullable();
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
        Schema::dropIfExists('criterionproblematics');
    }
}
