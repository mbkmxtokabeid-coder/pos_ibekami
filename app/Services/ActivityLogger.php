<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ActivityLogger
{
    /**
     * Suppress automatic Eloquent trait logging inside explicit controller actions
     * to prevent duplicate log rows for a single business operation.
     */
    protected static int $suppressDepth = 0;

    protected static ?bool $tableExistsCache = null;

    protected static array $sensitiveKeys = [
        'password',
        'remember_token',
        'api_token',
        '_token',
        'fcm_token',
        'device_token',
        'updated_at',
        'created_at',
    ];

    public static function withoutModelLogging(callable $callback)
    {
        self::$suppressDepth++;
        try {
            return $callback();
        } finally {
            self::$suppressDepth = max(0, self::$suppressDepth - 1);
        }
    }

    public static function isModelLoggingSuppressed(): bool
    {
        return self::$suppressDepth > 0;
    }

    public static function log(
        string $module,
        string $action,
        string $description,
        ?Model $subject = null,
        ?array $oldValues = null,
        ?array $newValues = null,
        string $severity = 'info',
        ?string $subjectLabel = null,
        $actor = null
    ): void {
        try {
            if (self::$tableExistsCache === null) {
                self::$tableExistsCache = Schema::hasTable('activity_logs');
            }
            if (!self::$tableExistsCache) {
                return;
            }

            $user = $actor ?: Auth::user();
            $request = app()->bound('request') ? request() : null;

            $cleanOld = self::sanitize($oldValues);
            $cleanNew = self::sanitize($newValues);

            $label = $subjectLabel;
            if (!$label && $subject) {
                $label = self::resolveSubjectLabel($subject);
            }

            ActivityLog::create([
                'user_id' => $user ? $user->id : null,
                'user_name' => $user ? ($user->nama ?? $user->name ?? $user->email ?? 'User #' . $user->id) : 'Sistem / Tamu',
                'user_role' => $user ? ($user->role ?? 'User') : 'Sistem',
                'module' => strtolower(trim($module)),
                'action' => strtolower(trim($action)),
                'severity' => in_array($severity, ['info', 'warning', 'critical'], true) ? $severity : 'info',
                'subject_type' => $subject ? get_class($subject) : null,
                'subject_id' => $subject ? $subject->getKey() : null,
                'subject_label' => $label ? mb_substr($label, 0, 180) : null,
                'description' => $description,
                'old_values' => !empty($cleanOld) ? $cleanOld : null,
                'new_values' => !empty($cleanNew) ? $cleanNew : null,
                'ip_address' => $request ? $request->ip() : null,
                'user_agent' => $request ? mb_substr((string) $request->userAgent(), 0, 255) : null,
                'url' => $request ? mb_substr((string) $request->fullUrl(), 0, 255) : null,
            ]);
        } catch (\Throwable $e) {
            Log::warning('ActivityLogger failed: ' . $e->getMessage());
        }
    }

    public static function sanitize(?array $values): ?array
    {
        if (empty($values)) {
            return null;
        }

        $result = [];
        foreach ($values as $key => $val) {
            if (in_array(strtolower((string) $key), self::$sensitiveKeys, true)) {
                continue;
            }
            if (is_string($val) && mb_strlen($val) > 500) {
                $val = mb_substr($val, 0, 500) . '…';
            }
            $result[$key] = $val;
        }

        return empty($result) ? null : $result;
    }

    public static function resolveSubjectLabel(Model $model): string
    {
        $class = class_basename($model);
        foreach (['nomor_invoice', 'nomor_inv', 'no_spj', 'no_spb', 'nama_vendor', 'jenis_barang', 'jenis_material', 'nama_barang', 'nama_invoice', 'nama_budget', 'nama', 'customer'] as $attr) {
            if (!empty($model->{$attr})) {
                $prefix = match ($class) {
                    'Penjualan' => 'Invoice #',
                    'Pembelian' => 'Pembelian #',
                    'Spk' => 'SPK #',
                    'Spb' => 'SPB #',
                    'Spj' => 'SPJ #',
                    default => $class . ' ',
                };
                return $prefix . $model->{$attr};
            }
        }
        return $class . ' #' . $model->getKey();
    }
}
