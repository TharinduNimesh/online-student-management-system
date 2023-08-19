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

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function grades()
    {
        return $this->hasMany(AcademicInformation::class, 'student_id');
    }
}
