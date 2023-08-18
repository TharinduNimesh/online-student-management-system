<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'date_of_birth',
        'city_id',
        'gender_id',
        'verified_at',
    ];

    public $timestamps = false;
}
