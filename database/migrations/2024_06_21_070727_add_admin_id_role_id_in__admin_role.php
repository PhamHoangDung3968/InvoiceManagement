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
        Schema::table('tbl_AdminRole', function (Blueprint $table) {
            //
            $table->unsignedInteger('Admin_id')->after('id');
            $table->foreign('Admin_id')
                    ->references('admin_id')->on('tbl_admin')
                    ->onDelete('cascade');
            $table->unsignedInteger('Role_id')->after('id');
            $table->foreign('Role_id')
                    ->references('id')->on('tbl_Roles')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_AdminRole', function (Blueprint $table) {
            //
        });
    }
};
