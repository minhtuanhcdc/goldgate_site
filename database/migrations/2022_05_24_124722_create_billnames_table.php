<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billnames', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billtest_id')->constrained()->setNullOnDelete();
            $table->foreignId('testname_id')->constrained()->setNullOnDelete();
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
        Schema::dropIfExists('billnames');
    }
}
