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
        Schema::table('tbl_HangHoa', function (Blueprint $table) {
            //
            $table->unsignedInteger('NhaCungCap_id')->after('DVT');
            $table->foreign('NhaCungCap_id')
                    ->references('id')->on('tbl_NhaCungCap')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_HangHoa', function (Blueprint $table) {
            //
        });
    }
};
