<?php

namespace App\Models;

use finfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'year',
        'date',
        'days',
        'syukkin',
        'taikin',
        'rests1',
        'reste1',
        'rests2',
        'reste2',
        'state',
    ];

    protected $casts = [
        'date' => 'date',
        'syukkin' => 'datetime:H:i:s',
        'taikin' => 'datetime:H:i:s',
        'rests1' => 'datetime:H:i:s',
        'reste1' => 'datetime:H:i:s',
        'rests2' => 'datetime:H:i:s',
        'reste2' => 'datetime:H:i:s',
        'state' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function correction()
    {
        return $this->hasMany(AttendanceCorrection::class);
    }
}
