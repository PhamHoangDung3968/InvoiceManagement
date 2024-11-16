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
        Schema::create('tbl_KhachHang', function (Blueprint $table) {
            $table->increments('MaKhachHang');
            $table->string("TenKhachHang", 255);
            $table->string("MST", 30);
            $table->string("DiaChi", 255);
            $table->string("SDT", 20)->nullable();
            $table->string("Email", 255)->nullable();
            $table->string("STK_NganHang", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_KhachHang');
    }
};
