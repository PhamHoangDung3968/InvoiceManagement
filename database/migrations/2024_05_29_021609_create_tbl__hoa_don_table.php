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
        Schema::create('tbl_HoaDon', function (Blueprint $table) {
            $table->increments('id');
            $table->string("THDon", 255);
            $table->string("SHDon", 30);
            $table->date("NLap");
            $table->integer("TrangThai");
            $table->string("File", 255)->nullable();
            $table->string("TenFileThem", 255)->nullable();
            $table->string("PTTT", 255)->nullable();
            $table->string("MaThamChieu", 255)->nullable();
            $table->bigInteger("TongTienHang")->nullable();
            $table->bigInteger("ThanhTienSauThue")->nullable();
            $table->integer("TienThue")->nullable();
            $table->string("TenNCC", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_HoaDon');
    }
};
