<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); //外部キーとして参照させるのでunsigned
            $table->string('facility_code',4);
            $table->foreign('user_id')->references('id')->on('users'); //外部キー参照のための記述
            $table->foreign('facility_code')->references('facility_code')->on('facilities'); //上に同じ
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('reserve_number',191);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserves');
    }
}
