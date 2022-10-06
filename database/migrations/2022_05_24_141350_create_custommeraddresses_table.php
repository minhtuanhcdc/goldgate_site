<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustommeraddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custommeraddresses', function (Blueprint $table) {
            $table->id();
            $table->integer('phone');
            $table->foreignId('custommer_id')->constrained()->setNullOnDelete();
            $table->foreignId('province_id')->constrained()->setNullOnDelete();
            $table->foreignId('district_id')->constrained()->setNullOnDelete();
            $table->foreignId('ward_id')->constrained()->setNullOnDelete();
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
        Schema::dropIfExists('custommeraddresses');
    }
}
