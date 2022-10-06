<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testelements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value_max');
            $table->string('value_min');
            $table->foreignId('testname_id')->nullable()->constrained()->setNullOnDelete();
            $table->string('element_group');
            $table->foreignId('unit_id')->nullable()->constrained()->setNullOnDelete();
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
        Schema::dropIfExists('testelements');
    }
}
