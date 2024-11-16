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
        Schema::create('tbl_ChiTietHoaDonDauRa', function (Blueprint $table) {
            $table->increments('id');
            $table->string("SoHoaDon", 255);
            $table->string("TenHangHoa", 255);
            $table->integer("DonGia");
            $table->integer("SoLuong");
            $table->bigInteger("ThanhTien");
            $table->integer("ThueSuat")->nullable();
            $table->integer("TienThueGTGT")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ChiTietHoaDonDauRa');
    }
};
