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
        Schema::table('tbl_HoaDonDauRa', function (Blueprint $table) {
            //
            $table->unsignedInteger('Ma_KhachHang')->after('PTTT');
            $table->foreign('Ma_KhachHang')
                    ->references('MaKhachHang')->on('tbl_KhachHang')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_HoaDonDauRa', function (Blueprint $table) {
            //
        });
    }
};
