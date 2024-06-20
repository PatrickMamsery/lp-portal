<?php

namespace App\Livewire;

use Livewire\Component;

class LessonDevelopmentComponent extends Component
{
    public $lessonStages = [
        [
            'stage' => 'INTRODUCTION',
            'time' => '10min',
            'teachingActivities' => 'Through Oral question to give meaning of warning sign',
            'learningActivities' => 'Responding on the meaning of warning sign',
            'assessment' => 'Listening on their explanation about warning sign'
        ],
        [
            'stage' => 'DEVELOPING NEW KNOWLEDGE',
            'time' => '20min',
            'teachingActivities' => 'Think pair and share to explain different warning signs found in different containers',
            'learningActivities' => 'In pair to give and listen different warning signs found in different chemical containers',
            'assessment' => 'Check if they pay attention'
        ],
        [
            'stage' => 'REINFORCEMENT',
            'time' => '20min',
            'teachingActivities' => 'Describe the measures on how to handle chemicals with different warning signs',
            'learningActivities' => 'Take note on the measures to be taken when dealing with different chemicals',
            'assessment' => 'Check if they take note'
        ],
        [
            'stage' => 'REFLECTION',
            'time' => '15min',
            'teachingActivities' => 'Clearing all challenges and summarize it',
            'learningActivities' => 'Take summary and give out their challenges',
            'assessment' => 'Through their challenges'
        ],
        [
            'stage' => 'CONCLUSION',
            'time' => '15min',
            'teachingActivities' => 'Guiding student to attempt the exercise',
            'learningActivities' => 'Write and perform an exercise given',
            'assessment' => 'Marking the exercise'
        ]
    ];

    public $studentEvaluation;
    public $teacherEvaluation;
    public $remarks;

    public function updated()
    {
        //
    }

    public $newStage = [
        'stage' => '',
        'time' => '',
        'teachingActivities' => '',
        'learningActivities' => '',
        'assessment' => ''
    ];

    public function addLessonStage()
    {
        $this->lessonStages[] = $this->newStage;
        $this->reset('newStage');
    }

    public function save()
    {
        // Save logic here
    }

    public function render()
    {
        return view('livewire.lesson-development-component', [
            'lessonStages' => $this->lessonStages,
        ]);
    }
}
