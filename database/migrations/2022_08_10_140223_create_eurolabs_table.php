<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEurolabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eurolabs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('addressSG');
            $table->string('addressHN');
            $table->string('phone');
            $table->string('website');
            $table->string('logo');
            $table->string('logobackground_HPV');
            $table->string('logobackground_Thin');
            $table->integer('view_background_HPV');
            $table->integer('view_background_Thin');
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
        Schema::dropIfExists('eurolabs');
    }
}
