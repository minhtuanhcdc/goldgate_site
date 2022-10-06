<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOusentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ousents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('logo');
            $table->string('person_contact');
            $table->string('phone');
            $table->string('id_ou');
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
        Schema::dropIfExists('ousents');
    }
}
