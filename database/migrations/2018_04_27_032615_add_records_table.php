<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->string('title');
            $table->integer('artist_id')->unsigned()->index();
            $table->foreign('artist_id')
                ->references('id')
                ->on('artists');
            $table->integer('folder_id')->unsigned()->index();
            $table->foreign('folder_id')
                ->references('id')
                ->on('folders');
            $table->string('year');
            $table->string('thumb');
            $table->string('cover');
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
        Schema::dropIfExists('records');
    }
}
