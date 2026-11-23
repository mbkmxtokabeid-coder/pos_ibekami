<?php

namespace App\Traits;

use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Model;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function (Model $model) {
            if (ActivityLogger::isModelLoggingSuppressed()) {
                return;
            }
            $module = method_exists($model, 'activityLogModule') ? $model->activityLogModule() : strtolower(class_basename($model));
            $label = ActivityLogger::resolveSubjectLabel($model);

            ActivityLogger::log(
                $module,
                'create',
                "Menambahkan {$label}",
                $model,
                null,
                $model->getAttributes(),
                'info',
                $label
            );
        });

        static::updated(function (Model $model) {
            if (ActivityLogger::isModelLoggingSuppressed()) {
                return;
            }

            $dirty = $model->getDirty();
            unset($dirty['updated_at'], $dirty['remember_token']);
            if (empty($dirty)) {
                return;
            }

            $old = [];
            $new = [];
            foreach ($dirty as $key => $val) {
                $old[$key] = $model->getOriginal($key);
                $new[$key] = $val;
            }

            $module = method_exists($model, 'activityLogModule') ? $model->activityLogModule() : strtolower(class_basename($model));
            $label = ActivityLogger::resolveSubjectLabel($model);

            $severity = 'warning';
            if (isset($new['role']) || isset($new['password']) || isset($new['status'])) {
                $severity = ($module === 'user' || ($new['status'] ?? '') === 'Batal' || ($new['status'] ?? '') === 'Lunas')
                    ? 'critical'
                    : 'warning';
            }

            ActivityLogger::log(
                $module,
                'update',
                "Memperbarui {$label}",
                $model,
                $old,
                $new,
                $severity,
                $label
            );
        });

        static::deleted(function (Model $model) {
            if (ActivityLogger::isModelLoggingSuppressed()) {
                return;
            }
            $module = method_exists($model, 'activityLogModule') ? $model->activityLogModule() : strtolower(class_basename($model));
            $label = ActivityLogger::resolveSubjectLabel($model);

            ActivityLogger::log(
                $module,
                'delete',
                "Menghapus {$label}",
                $model,
                $model->getOriginal(),
                null,
                'critical',
                $label
            );
        });
    }
}
