<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoodUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mood_updates', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_update')->default(NOW());
            $table->unsignedBigInteger('post_id')->unsigned();
            $table->unsignedBigInteger('mood_weight_id')->unsigned();
            $table->string('status');
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
        Schema::dropIfExists('mood_updates');
    }
}
