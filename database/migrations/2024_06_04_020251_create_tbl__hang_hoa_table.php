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
        Schema::create('tbl_HangHoa', function (Blueprint $table) {
            $table->increments('MaHangHoa');
            $table->string("TenHangHoa", 255);
            $table->integer("GiaBan");
            $table->string("DVT", 20);
            // $table->string("NhaCungCap_id", 255);
            
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_HangHoa');
    }
};
