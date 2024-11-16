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
        Schema::create('tbl_ThongKeKhachHang', function (Blueprint $table) {
            $table->increments('id');
            $table->date("NLap")->nullable();
            $table->bigInteger("SoTien")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ThongKeKhachHang');
    }
};
