<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\GradeFactory;

class AcademicInformation extends Model
{
    use HasFactory;

    protected $table = 'academic_details';

    protected $fillable = [
        'year',
        'student_id',
        'has_paid',
        'grade',
    ];

    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
