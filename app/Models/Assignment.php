<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $table = 'assignments';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'started_at',
        'ended_at',
        'subject_id',
        'grade',
        'uploaded_by',
        'assignment_status',
        'file_name',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
