<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('penjualan', 'lokasi_pengerjaan')) {
            Schema::table('penjualan', function (Blueprint $table) {
                $table->string('lokasi_pengerjaan', 20)->default('internal')->after('order_by');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('penjualan', 'lokasi_pengerjaan')) {
            Schema::table('penjualan', function (Blueprint $table) {
                $table->dropColumn('lokasi_pengerjaan');
            });
        }
    }
};
