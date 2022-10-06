<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilltestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billtests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custommer_id')->constrained()->setNullOnDelete();
            $table->foreignId('ousent_id')->constrained()->setNullOnDelete();
            $table->foreignId('doctor_id')->constrained()->setNullOnDelete();
            $table->string('diagonose');
            $table->string('hpv_code');
            $table->string('thinprep_code')->unique();
            $table->string('sample_code');
            $table->integer('status');
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
        Schema::dropIfExists('billtests');
    }
}
