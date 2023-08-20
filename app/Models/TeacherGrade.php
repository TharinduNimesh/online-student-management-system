<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherGrade extends Model
{
    use HasFactory;
    protected $table = 'teacher_grades';

    protected $fillable = [
        'teacher_id',
        'grade'
    ];

    public $timestamps = false;

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
