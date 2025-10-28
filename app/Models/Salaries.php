<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salaries extends Model
{
    protected $fillable = [
        'karyawan_id',
        'bulan',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji',
    ];
}