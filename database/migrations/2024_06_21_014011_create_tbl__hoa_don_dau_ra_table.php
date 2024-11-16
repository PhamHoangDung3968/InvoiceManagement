<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_HoaDonDauRa', function (Blueprint $table) {
            $table->increments('id');
            $table->string("TenHoaDon", 255);
            $table->string("SoHoaDon", 30);
            $table->date("NLap");
            $table->string("TenFileThem", 255)->nullable();
            $table->integer("TrangThai")->nullable();
            $table->string("PTTT", 255)->nullable();
            $table->bigInteger("ThanhTien")->nullable();
            $table->bigInteger("TienSauThue")->nullable();
            $table->integer("TienThue")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_HoaDonDauRa');
    }
};
