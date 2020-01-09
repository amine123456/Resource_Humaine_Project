<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Absences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cin');
            $table->string('name');
            $table->string('email')->unique();
            $table->Date('absenter');
            $table->Date('jusqua');
            $table->String('certificat');
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
        Schema::dropIfExists('Absences');
    }
}
