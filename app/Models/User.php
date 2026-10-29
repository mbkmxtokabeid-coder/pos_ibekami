<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'nomor_telepon',
        'role',
        'status',
        'device_token',
        'tanda_tangan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'role',
        'device_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute()
    {
        return $this->nama;
    }

    public function getTandaTanganUrlAttribute()
    {
        return self::resolveSignatureUrl($this->tanda_tangan, $this->id, $this->nama);
    }

    public static function resolveSignatureUrl(?string $fileName, ?int $adminId = null, ?string $adminName = null): ?string
    {
        if (empty($fileName)) {
            // Fallback khusus untuk Namira historis jika belum ada file baru
            if (($adminId == 8 || ($adminName && stripos($adminName, 'Namira') !== false))) {
                return self::formatSignatureUrl('images/ttd.png');
            }
            return null;
        }

        if (str_starts_with($fileName, 'http://') || str_starts_with($fileName, 'https://')) {
            return $fileName;
        }

        $cleanName = basename($fileName);

        // Ekstraksi admin ID dari nama file (misal: ttd_33_1793254451_6ae2e433c5f22.png => 33)
        if (!$adminId && preg_match('/ttd_(\d+)_/i', $cleanName, $matchesId)) {
            $adminId = (int)$matchesId[1];
        }

        $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? null;
        $baseDirs = array_filter(array_unique([
            public_path(),
            base_path(),
            base_path('public'),
            base_path('public_html'),
            base_path('public_html/pos'),
            dirname(base_path()) . '/public_html/pos',
            dirname(base_path()) . '/pos',
            $docRoot,
            $docRoot ? rtrim($docRoot, '/\\') . '/pos' : null,
            $docRoot ? dirname($docRoot) . '/pos' : null,
            $docRoot ? dirname($docRoot) . '/public_html/pos' : null,
        ]));

        // 1. Cek file persis di subfolder images/signatures/
        foreach ($baseDirs as $dir) {
            $path = rtrim($dir, '/\\') . '/images/signatures/' . $cleanName;
            if (file_exists($path)) {
                return self::formatSignatureUrl('images/signatures/' . $cleanName);
            }
        }

        // 2. Cek file persis di folder images/ langsung
        foreach ($baseDirs as $dir) {
            $path = rtrim($dir, '/\\') . '/images/' . $cleanName;
            if (file_exists($path)) {
                return self::formatSignatureUrl('images/' . $cleanName);
            }
        }

        // 3. Cek path mentah jika ada subfolder
        foreach ($baseDirs as $dir) {
            $path = rtrim($dir, '/\\') . '/' . ltrim($fileName, '/\\');
            if (file_exists($path)) {
                return self::formatSignatureUrl(ltrim($fileName, '/\\'));
            }
        }

        // 4. Toleransi Otomatis: Jika nama file beda timestamp/hash (misal ttd_33_1793254451 vs ttd_33_1793249957),
        // cari file tanda tangan milik admin ID tersebut yang sudah ada di folder signatures
        if ($adminId) {
            foreach ($baseDirs as $dir) {
                $sigDir = rtrim($dir, '/\\') . '/images/signatures';
                if (is_dir($sigDir)) {
                    // Cek pola ttd_{adminId}_*.*
                    $matches = glob($sigDir . '/ttd_' . $adminId . '_*.*');
                    if (!empty($matches)) {
                        usort($matches, function ($a, $b) {
                            return filemtime($b) - filemtime($a);
                        });
                        $matchedFile = basename($matches[0]);
                        return self::formatSignatureUrl('images/signatures/' . $matchedFile);
                    }

                    // Cek juga jika ada file dengan ID tersebut
                    $matchesCustom = glob($sigDir . '/*' . $adminId . '*.*');
                    if (!empty($matchesCustom)) {
                        return self::formatSignatureUrl('images/signatures/' . basename($matchesCustom[0]));
                    }
                }
            }
        }

        // 5. Fallback berdasarkan nama admin (misal Zisca / Namira) jika ada file di server
        if ($adminName) {
            $cleanAdmin = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $adminName));
            foreach ($baseDirs as $dir) {
                $sigDir = rtrim($dir, '/\\') . '/images/signatures';
                if (is_dir($sigDir)) {
                    $matchesName = glob($sigDir . '/*' . $cleanAdmin . '*.*');
                    if (!empty($matchesName)) {
                        return self::formatSignatureUrl('images/signatures/' . basename($matchesName[0]));
                    }
                }
            }
        }

        // 6. Default URL jika file sudah di-upload ke server web
        return self::formatSignatureUrl('images/signatures/' . $cleanName);
    }

    public static function formatSignatureUrl(string $relativePath): string
    {
        $url = asset($relativePath);
        if (request()->isSecure() || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')) {
            $url = preg_replace('/^http:/i', 'https:', $url);
        }
        return $url;
    }
}
