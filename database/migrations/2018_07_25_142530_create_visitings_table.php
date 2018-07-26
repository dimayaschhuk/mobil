<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('visitings')) {
            Schema::create('visitings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('schedules_id');
                $table->integer('students_id');
                $table->integer('status');
                $table->date('data');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitings');
    }
}
