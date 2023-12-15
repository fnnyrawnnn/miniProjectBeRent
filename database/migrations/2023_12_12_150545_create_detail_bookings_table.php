<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detail_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('qty')->default(1);
            $table->dateTime('waktu_pengembalian');
            $table->foreignId('booking_id');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreignId('paket_id');
            $table->foreign('paket_id')->references('id')->on('paket_alats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('detail_bookings');
    }
};
