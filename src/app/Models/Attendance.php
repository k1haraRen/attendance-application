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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function textes()
    {
        return $this->hasMany(Text::class);
    }
}
