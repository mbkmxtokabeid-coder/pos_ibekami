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
            $table->index('jenis_pembayaran', 'idx_penjualan_jenis_bayar');
            $table->index(['deleted_at', 'jenis_pembayaran', 'tgl_penjualan'], 'idx_penjualan_del_jenis_tgl');
        });

        if (Schema::hasTable('spk')) {
            Schema::table('spk', function (Blueprint $table) {
                $table->index('status_spk', 'idx_spk_status_spk');
                $table->index('status_kerja', 'idx_spk_status_kerja');
                $table->index('created_at', 'idx_spk_created_at');
            });
        }

        if (Schema::hasTable('pembelian')) {
            Schema::table('pembelian', function (Blueprint $table) {
                $table->index(['status', 'sisa'], 'idx_pembelian_status_sisa');
                $table->index('id_vendor', 'idx_pembelian_vendor');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropIndex('idx_penjualan_jenis_bayar');
            $table->dropIndex('idx_penjualan_del_jenis_tgl');
        });

        if (Schema::hasTable('spk')) {
            Schema::table('spk', function (Blueprint $table) {
                $table->dropIndex('idx_spk_status_spk');
                $table->dropIndex('idx_spk_status_kerja');
                $table->dropIndex('idx_spk_created_at');
            });
        }

        if (Schema::hasTable('pembelian')) {
            Schema::table('pembelian', function (Blueprint $table) {
                $table->dropIndex('idx_pembelian_status_sisa');
                $table->dropIndex('idx_pembelian_vendor');
            });
        }
    }
};
