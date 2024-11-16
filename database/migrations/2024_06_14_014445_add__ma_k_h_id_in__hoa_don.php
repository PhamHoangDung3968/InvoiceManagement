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
        Schema::table('tbl_HoaDon', function (Blueprint $table) {
            $table->unsignedInteger('MaDN_id')->after('File');
            $table->foreign('MaDN_id')
                    ->references('id')->on('tbl_DoanhNghiep')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_HoaDon', function (Blueprint $table) {
            //
        });
    }
};
