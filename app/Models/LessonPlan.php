<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'school_id',
        'grade_id',
        'stream_id',
        'subject_id',
        'topic_id',
        'subtopic_id',
        'competence_id',

        'intro_time',
        'intro_teacher_activities',
        'intro_student_activities',
        'intro_assessment',

        'new_knowledge_time',
        'new_knowledge_teacher_activities',
        'new_knowledge_student_activities',
        'new_knowledge_assessment',

        'reinforcement_time',
        'reinforcement_teacher_activities',
        'reinforcement_student_activities',
        'reinforcement_assessment',

        'reflection_time',
        'reflection_teacher_activities',
        'reflection_student_activities',
        'reflection_assessment',

        'conclusion_time',
        'conclusion_teacher_activities',
        'conclusion_student_activities',
        'conclusion_assessment',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function stream()
    {
        return $this->belongsTo(Stream::class, 'stream_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function subtopic()
    {
        return $this->belongsTo(Subtopic::class);
    }

    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }
}
