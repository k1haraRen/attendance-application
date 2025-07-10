<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained();
            $table->integer('year');
            $table->date('date');
            $table->string('days');
            $table->time('syukkin')->nullable();
            $table->time('taikin')->nullable();
            $table->time('rests1')->nullable();
            $table->time('reste1')->nullable();
            $table->time('rests2')->nullable();
            $table->time('reste2')->nullable();
            $table->boolean('state')->default(false);
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
        Schema::dropIfExists('attendances');
    }
}
