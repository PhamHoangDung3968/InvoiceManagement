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
        Schema::table('tbl_ChiTietHoaDonDauRa', function (Blueprint $table) {
            $table->unsignedInteger('Ma_HoaDon')->after('id');
            $table->foreign('Ma_HoaDon')
                    ->references('id')->on('tbl_HoaDonDauRa')
                    ->onDelete('cascade');
            $table->unsignedInteger('Ma_HangHoa')->after('id');
            $table->foreign('Ma_HangHoa')
                    ->references('MaHangHoa')->on('tbl_HangHoaDoanhNghiep')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_ChiTietHoaDonDauRa', function (Blueprint $table) {
            //
        });
    }
};
