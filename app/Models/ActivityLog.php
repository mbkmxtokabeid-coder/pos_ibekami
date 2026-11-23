<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    public const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_role',
        'module',
        'action',
        'severity',
        'subject_type',
        'subject_id',
        'subject_label',
        'description',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'url',
        'created_at',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Role-based visibility scope:
     * - Pemilik: semua log (semua role & modul)
     * - Admin / Admintkb: aktivitas sendiri + semua tim non-Pemilik (tidak bisa melihat aktivitas Pemilik)
     * - Role lain (Stockist, Produksi, Magang, dll.): hanya aktivitas miliknya sendiri
     */
    public function scopeVisibleTo(Builder $query, ?User $user): Builder
    {
        if (!$user) {
            return $query->whereRaw('1 = 0');
        }

        $role = strtolower(trim((string) $user->role));

        if ($role === 'pemilik') {
            return $query;
        }

        if (in_array($role, ['admin', 'admintkb'], true)) {
            return $query->where(function (Builder $q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhereRaw('LOWER(user_role) != ?', ['pemilik']);
            });
        }

        return $query->where('user_id', $user->id);
    }

    public function isVisibleTo(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        $role = strtolower(trim((string) $user->role));
        if ($role === 'pemilik') {
            return true;
        }

        if (in_array($role, ['admin', 'admintkb'], true)) {
            return ((int) $this->user_id === (int) $user->id)
                || (strtolower(trim((string) $this->user_role)) !== 'pemilik');
        }

        return (int) $this->user_id === (int) $user->id;
    }
}
