<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    public const STATUS_OPTIONS = [
        'aktif',
        'nonaktif',
    ];

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'departemen_id',
        'jabatan_id',
        'status',
    ];
    
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }
    
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    public function salaries(): HasMany
    {
        return $this->hasMany(Salaries::class, 'karyawan_id');
    }

    public function latestSalary(): HasOne
    {
        return $this->hasOne(Salaries::class, 'karyawan_id')->latestOfMany();
    }
}
