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
        Schema::table('penjualan', function (Blueprint $table) {
            $table->index('customer', 'idx_penjualan_customer');
            $table->index('perusahaan', 'idx_penjualan_perusahaan');
            $table->index('no_telepon', 'idx_penjualan_no_telepon');
            $table->index(['deleted_at', 'invoice'], 'idx_penjualan_del_invoice');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropIndex('idx_penjualan_customer');
            $table->dropIndex('idx_penjualan_perusahaan');
            $table->dropIndex('idx_penjualan_no_telepon');
            $table->dropIndex('idx_penjualan_del_invoice');
        });
    }
};
