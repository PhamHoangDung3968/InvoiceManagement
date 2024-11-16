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
        Schema::create('tbl_NhaCungCap', function (Blueprint $table) {
            $table->increments('id');
            $table->string("Ten", 255);
            $table->string("MST", 30);
            $table->string("DChi", 255);
            $table->string("SDThoai", 20)->nullable();
            $table->string("DCTDTu", 255)->nullable();
            $table->string("Fax", 255)->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_NhaCungCap');
    }
};
