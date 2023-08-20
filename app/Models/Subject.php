<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = "subjects";

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_has_subjects');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
