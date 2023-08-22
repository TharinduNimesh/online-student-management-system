<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;
    protected $table = 'academic_officers';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'city_id',
        'gender_id',
        'is_removed',
        'verified_at',
    ];
}
