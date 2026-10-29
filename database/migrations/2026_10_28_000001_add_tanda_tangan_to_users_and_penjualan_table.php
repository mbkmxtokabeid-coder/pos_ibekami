<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Tambah kolom tanda_tangan ke tabel users
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'tanda_tangan')) {
                $table->string('tanda_tangan')->nullable()->after('role');
            }
        });

        // 2. Tambah kolom tanda_tangan ke tabel penjualan (untuk snapshot tanda tangan)
        Schema::table('penjualan', function (Blueprint $table) {
            if (!Schema::hasColumn('penjualan', 'tanda_tangan')) {
                $table->string('tanda_tangan')->nullable()->after('admin');
            }
        });

        // 3. Set tanda tangan default untuk admin Namira (ID 8)
        $namira = DB::table('users')->where('id', 8)->first();
        if ($namira && empty($namira->tanda_tangan)) {
            DB::table('users')->where('id', 8)->update([
                'tanda_tangan' => 'ttd_namira.png',
            ]);
        }

        // 4. Pastikan invoice historis yang dibuat oleh Namira memiliki snapshot tanda tangan Namira
        DB::table('penjualan')
            ->where('admin', 8)
            ->whereNull('tanda_tangan')
            ->update([
                'tanda_tangan' => 'ttd_namira.png',
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'tanda_tangan')) {
                $table->dropColumn('tanda_tangan');
            }
        });

        Schema::table('penjualan', function (Blueprint $table) {
            if (Schema::hasColumn('penjualan', 'tanda_tangan')) {
                $table->dropColumn('tanda_tangan');
            }
        });
    }
};
