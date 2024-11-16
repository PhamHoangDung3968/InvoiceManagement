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
        Schema::table('tbl_ChiTietHoaDon', function (Blueprint $table) {
            $table->unsignedInteger('MaHD_id')->after('id');
            $table->foreign('MaHD_id')
                    ->references('id')->on('tbl_HoaDon')
                    ->onDelete('cascade');
            $table->unsignedInteger('MaHH_id')->after('id');
            $table->foreign('MaHH_id')
                    ->references('MaHangHoa')->on('tbl_HangHoa')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_ChiTietHoaDon', function (Blueprint $table) {
            //
        });
    }
};
