<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plat', function (Blueprint $table) {
            $table->dropForeign('plat_menuid_foreign');
            $table->foreign('menuId')->references('id')->on('menu')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('plat', function (Blueprint $table) {
            $table->dropForeign('plat_menuid_foreign');
            $table->foreign('menuId')->references('id')->on('restaurant')->onDelete('cascade');
        });
    }
};
