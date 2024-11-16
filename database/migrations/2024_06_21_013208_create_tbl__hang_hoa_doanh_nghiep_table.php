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
        Schema::create('tbl_HangHoaDoanhNghiep', function (Blueprint $table) {
            $table->increments('MaHangHoa');
            $table->string("TenHangHoa", 255);
            $table->integer('SoLuongHienTai');
            $table->integer('SoLuongDaNhap')->nullable();
            $table->integer('SoTienThayDoi')->nullable();
            $table->integer('SoLuongDaBan')->nullable();
            $table->integer('TrangThai')->nullable();
            $table->integer("GiaBan");
            $table->string("DVT", 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_HangHoaDoanhNghiep');
    }
};
