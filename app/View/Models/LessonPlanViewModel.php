<?php

namespace App\View\Models;

use App\Enums\Font;
use Filament\Panel\Concerns\HasFont;
use App\Models\LessonPlan as ModelsLessonPlan;

class LessonPlanViewModel
{
    use HasFont;

    public ModelsLessonPlan $lessonPlan;

    public ?array $data = [];

    public function __construct(ModelsLessonPlan $lessonPlan, ?array $data = null)
    {
        $this->lessonPlan = $lessonPlan;
        $this->data = $data;
    }

    public function logo(): ?string
    {
        return $this->lessonPlan->logo_url;
    }

    public function show_logo(): bool
    {
        return $this->data['show_logo'] ?? $this->lessonPlan->show_logo ?? false;
    }

    // School Related methods
    public function school_name(): string
    {
        return $this->lessonPlan->school->name;
    }

    public function school_region(): string
    {
        return $this->lessonPlan->school->region ?? null;
    }

    public function school_district(): string
    {
        return $this->lessonPlan->school->district ?? null;
    }

    public function school_ward(): string
    {
        return $this->lessonPlan->school->ward ?? null;
    }

    // General Section related methods
    public function lesson_plan_date(): ?string
    {
        // Check if the date property is not null
        if ($this->lessonPlan->date) {
            return $this->lessonPlan->date->format('d/m/Y');
        } else {
            return ''; // Return an empty string or handle the case accordingly
        }
    }

    public function teacher_name(): ?string
    {
        return $this->lessonPlan->teacher?->name;
    }

    public function grade(): ?string
    {
        return $this->lessonPlan->grade?->name;
    }

    public function stream(): ?string
    {
        return $this->lessonPlan->stream?->name;
    }

    public function lesson_start_time(): ?string
    {
        return $this->lessonPlan->start_time?->format('H:i');
    }

    public function lesson_end_time(): ?string
    {
        return $this->lessonPlan->end_time?->format('H:i');
    }

    public function subject_name(): ?string
    {
        return $this->lessonPlan->subject?->name;
    }

    // Lesson Details related methods
    public function topic_name(): ?string
    {
        return $this->lessonPlan->topic?->name;
    }

    public function subtopic_name(): ?string
    {
        return $this->lessonPlan->subtopic?->name;
    }

    public function competence_name(): ?string
    {
        return $this->lessonPlan->competence?->name;
    }

    // Header related methods
    public function header(): string
    {
        return $this->data['header'] ?? 'Lesson Plan';
    }

    // public function fontFamily(): string
    // {
    //     dd($this->data);
    //     if ($this->data['font']) {
    //         return Font::from($this->data['font'])->getLabel();
    //     }

    //     if ($this->lessonPlan->font) {
    //         return $this->lessonPlan->font->getLabel();
    //     }

    //     return Font::from(Font::DEFAULT)->getLabel();
    // }

    public function buildViewData(): array
    {
        return [
            'logo' => $this->logo(),
            'show_logo' => $this->show_logo(),
            'school_name' => $this->school_name(),
            'school_region' => $this->school_region(),
            'school_district' => $this->school_district(),
            'school_ward' => $this->school_ward(),
            'lesson_plan_date' => $this->lesson_plan_date(),
            'teacher_name' => $this->teacher_name(),
            'grade' => $this->grade(),
            'stream' => $this->stream(),
            'lesson_start_time' => $this->lesson_start_time(),
            'lesson_end_time' => $this->lesson_end_time(),
            'subject_name' => $this->subject_name(),
            'topic_name' => $this->topic_name(),
            'subtopic_name' => $this->subtopic_name(),
            'competence_name' => $this->competence_name(),
            'header' => $this->header(),
            // 'font_family' => $this->fontFamily(),
            // 'font_html' => $this->font($this->fontFamily())->getFontHtml(),
        ];
    }
}
