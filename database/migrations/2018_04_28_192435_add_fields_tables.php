<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('field_record', function (Blueprint $table) {
            $table->integer('record_id')->unsigned()->index();
            $table->foreign('record_id')
                ->references('id')
                ->on('records');
            $table->integer('field_id')->unsigned()->index();
            $table->foreign('field_id')
                ->references('id')
                ->on('fields');
            $table->string('value');
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
        Schema::dropIfExists('field_record');
        Schema::dropIfExists('fields');
    }
}
