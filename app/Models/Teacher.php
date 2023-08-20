<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'city_id',
        'gender_id',
        'is_removed',
        'verified_at',    
    ];

    public $timestamps = false;

    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'teacher_has_subjects');
    }

    public function grades() {
        return $this->hasMany(TeacherGrade::class);
    }

    public function assignments() {
        return $this->hasMany(Assignment::class, 'uploaded_by');
    }

    public function notes() {
        return $this->hasMany(Note::class, 'uploaded_by');
    }
}