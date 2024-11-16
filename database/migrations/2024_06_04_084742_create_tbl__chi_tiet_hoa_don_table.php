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
        Schema::create('tbl_ChiTietHoaDon', function (Blueprint $table) {
            $table->increments('id');
            $table->string("SoHD", 255);
            $table->string("TenHH", 255);
            $table->integer("DonGia")->nullable();
            $table->integer("SoLuong")->nullable();
            $table->integer("ThanhTien")->nullable();
            $table->float("ChietKhau")->nullable();
            $table->integer("GiaTruocThueGTGT")->nullable();
            $table->integer("ThueSuat")->nullable();
            $table->integer("TienThueGTGT")->nullable();
            $table->integer("ThanhTienSauThue")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ChiTietHoaDon');
    }
};
