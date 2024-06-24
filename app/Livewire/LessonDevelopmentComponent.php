<?php

namespace App\Livewire;

use App\Models\LessonPlan;
use Livewire\Component;
use Illuminate\Support\Facades\App;
use App\Models\Stage;

class LessonDevelopmentComponent extends Component
{
    // public $lessonStages = [
    //     [
    //         'stage' => 'INTRODUCTION',
    //         'time' => '10min',
    //         'teachingActivities' => 'Through Oral question to give meaning of warning sign',
    //         'learningActivities' => 'Responding on the meaning of warning sign',
    //         'assessment' => 'Listening on their explanation about warning sign'
    //     ],
    //     [
    //         'stage' => 'DEVELOPING NEW KNOWLEDGE',
    //         'time' => '20min',
    //         'teachingActivities' => 'Think pair and share to explain different warning signs found in different containers',
    //         'learningActivities' => 'In pair to give and listen different warning signs found in different chemical containers',
    //         'assessment' => 'Check if they pay attention'
    //     ],
    //     [
    //         'stage' => 'REINFORCEMENT',
    //         'time' => '20min',
    //         'teachingActivities' => 'Describe the measures on how to handle chemicals with different warning signs',
    //         'learningActivities' => 'Take note on the measures to be taken when dealing with different chemicals',
    //         'assessment' => 'Check if they take note'
    //     ],
    //     [
    //         'stage' => 'REFLECTION',
    //         'time' => '15min',
    //         'teachingActivities' => 'Clearing all challenges and summarize it',
    //         'learningActivities' => 'Take summary and give out their challenges',
    //         'assessment' => 'Through their challenges'
    //     ],
    //     [
    //         'stage' => 'CONCLUSION',
    //         'time' => '15min',
    //         'teachingActivities' => 'Guiding student to attempt the exercise',
    //         'learningActivities' => 'Write and perform an exercise given',
    //         'assessment' => 'Marking the exercise'
    //     ]
    // ];

    public $lessonStages;

    // public $studentEvaluation;
    // public $teacherEvaluation;
    // public $remarks;

    public $studentEvaluation = 'Students were engaged and participated actively.';
    public $teacherEvaluation = 'Teacher explained the concepts clearly and managed the class well.';
    public $remarks = 'Overall, the lesson went smoothly with minor disruptions.';

    //all lesson plan entries
    //FORM
    public $stage_type;

    public $time;
    public $teachingActivity;
    public $learningActivity;
    public $assessment;
    public $title;

    public $leson_plan_id=1;

    //fetch lesson plan entries
    public function fetch(){
        $lessonStages = LessonPlan::with('stages')->find($this->leson_plan_id);

        if($lessonStages){
            $this->lessonStages = $lessonStages->stages;
        }

        return $lessonStages;
    }

    // populate form
    public function populateForm($stage){

        $stage = $this->getStage($stage);

        $this->stage_type = $stage->name;
        $this->time = $stage->time;
        $this->teachingActivity = $stage->teaching_activities;
        $this->learningActivity = $stage->learning_activities;
        $this->assessment = $stage->assessment;
    }

    //get stage
    public function getStage($stage){
        return Stage::where('lesson_plan_id', $this->leson_plan_id)->where('name', $stage)->first();
    }


    // export to pdf
    public function downloadLessonStages()
    {
        return response()->streamDownload(function () {
            $lessonStages = $this->lessonStages;

            $rows = [];
            foreach ($lessonStages as $stage) {
                $row_string = '<tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">' . $stage['stage'] . '</td>
                <td class="py-3 px-6 text-left">' . $stage['time'] . '</td>
                <td class="py-3 px-6 text-left">' . $stage['teachingActivities'] . '</td>
                <td class="py-3 px-6 text-left">' . $stage['learningActivities'] . '</td>
                <td class="py-3 px-6 text-left">' . $stage['assessment'] . '</td>
            </tr>';

                array_push($rows, $row_string);
            }

            $list = implode('', $rows);
            $title = 'Lesson Stages Preview';

            $html_view = '
        <style>
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #ffffff;
        }

        th, td {
            border: 1px solid #999;
            padding: 0.75rem;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }
        </style>
        <div class="table-responsive">
        <h3>' . $title . '  <span style="float:right">' . date('D, M d, Y') . '</span></h3>
            <table>
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Stage</th>
                        <th class="py-3 px-6 text-left">Time</th>
                        <th class="py-3 px-6 text-left">Teaching Activities</th>
                        <th class="py-3 px-6 text-left">Learning Activities</th>
                        <th class="py-3 px-6 text-left">Assessment</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    ' . $list . '
                </tbody>
            </table>
            <h2 class="font-semibold text-lg mt-4 mb-2">Evaluations Preview</h2>
                <div class="my-4">
                    <h3 class="font-semibold text-lg">Students\' Evaluation</h3>
                    <p>' . $this->studentEvaluation . '</p>
                </div>

                <div class="my-4">
                    <h3 class="font-semibold text-lg">Teacher\'s Evaluation</h3>
                    <p>' . $this->teacherEvaluation . '</p>
                </div>

                <div class="my-4">
                    <h3 class="font-semibold text-lg">Remarks</h3>
                    <p>' . $this->remarks . '</p>
                </div>
        </div>';

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($html_view);
            echo $pdf->stream();
        }, 'lesson_stages.pdf');
    }


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
        $this->fetch();
        return view('livewire.lesson-development-component', [
            'lessonStages' => $this->lessonStages,
        ]);
    }
}
