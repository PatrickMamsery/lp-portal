<?php

namespace App\Livewire;

use Filament\Forms\Components\Textarea;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class StageFormComponent extends Component implements HasForms
{
    use InteractsWithForms;
    public $title = 'INTRODUCTION';
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('time')
                    ->label('Time')
                    ->placeholder('Enter time')
                    ->required()
                    ->rules('required', 'string', 'max:255'),

                Textarea::make('teacher_activity')
                    ->label('Teacher Activity')
                    ->placeholder('Enter teacher activity')
                    ->required()
                    ->rules('required', 'string', 'max:255'),

                Textarea::make('learning_activity')
                    ->label('Learning Activity')
                    ->placeholder('Enter learning activity')
                    ->required()
                    ->rules('required', 'string', 'max:255'),

                Textarea::make('assessment')
                    ->label('Assessment')
                    ->placeholder('Enter assessment')
                    ->required()
                    ->rules('required', 'string', 'max:255'),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function render()
    {
        return view('livewire.stage-form-component');
    }
}
