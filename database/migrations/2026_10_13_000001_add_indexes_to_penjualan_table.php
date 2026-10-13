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
            // Index untuk pencarian dan filter invoice
            $table->index('tgl_penjualan', 'idx_penjualan_tgl');
            $table->index('status', 'idx_penjualan_status');
            $table->index('nomor_invoice', 'idx_penjualan_no_inv');
            $table->index('approval', 'idx_penjualan_approval');
            $table->index(['deleted_at', 'tgl_penjualan'], 'idx_penjualan_del_tgl');
            $table->index(['deleted_at', 'status'], 'idx_penjualan_del_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropIndex('idx_penjualan_tgl');
            $table->dropIndex('idx_penjualan_status');
            $table->dropIndex('idx_penjualan_no_inv');
            $table->dropIndex('idx_penjualan_approval');
            $table->dropIndex('idx_penjualan_del_tgl');
            $table->dropIndex('idx_penjualan_del_status');
        });
    }
};
