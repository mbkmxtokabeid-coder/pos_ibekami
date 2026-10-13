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
        Schema::table('pembelian', function (Blueprint $table) {
            if (!Schema::hasColumn('pembelian', 'jenis_invoice')) {
                $table->string('jenis_invoice', 50)->default('Barang')->after('nomor_inv');
            }
            if (!Schema::hasColumn('pembelian', 'ppn_persen')) {
                $table->decimal('ppn_persen', 5, 2)->default(0)->after('jenis_invoice');
            }
            if (!Schema::hasColumn('pembelian', 'ppn_nominal')) {
                $table->bigInteger('ppn_nominal')->default(0)->after('ppn_persen');
            }
            if (!Schema::hasColumn('pembelian', 'pph_persen')) {
                $table->decimal('pph_persen', 5, 2)->default(0)->after('ppn_nominal');
            }
            if (!Schema::hasColumn('pembelian', 'pph_nominal')) {
                $table->bigInteger('pph_nominal')->default(0)->after('pph_persen');
            }
            if (!Schema::hasColumn('pembelian', 'tanggal_jto')) {
                $table->date('tanggal_jto')->nullable()->after('tanggal');
            }
            if (!Schema::hasColumn('pembelian', 'approval')) {
                $table->string('approval', 191)->nullable()->default('Lock')->after('token');
            }
            if (!Schema::hasColumn('pembelian', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('approval');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelian', function (Blueprint $table) {
            $cols = ['jenis_invoice', 'ppn_persen', 'ppn_nominal', 'pph_persen', 'pph_nominal', 'tanggal_jto', 'approval', 'approved_at'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('pembelian', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
