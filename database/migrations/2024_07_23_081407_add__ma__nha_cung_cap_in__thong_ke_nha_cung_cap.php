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
        Schema::table('tbl_ThongKeNhaCungCap', function (Blueprint $table) {
            //
            $table->unsignedInteger('Ma_NhaCungCap')->after('id');
            $table->foreign('Ma_NhaCungCap')
                    ->references('id')->on('tbl_NhaCungCap')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_ThongKeNhaCungCap', function (Blueprint $table) {
            //
        });
    }
};
