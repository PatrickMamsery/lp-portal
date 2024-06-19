<?php

namespace App\Filament\Teacher\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use function Filament\authorize;
use Filament\Forms\Components\Grid;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Illuminate\Database\Eloquent\Model;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\ViewField;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use App\Models\LessonPlan as ModelsLessonPlan;
use Illuminate\Auth\Access\AuthorizationException;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class LessonPlan extends Page
{
    use InteractsWithFormActions;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static string $view = 'filament.teacher.pages.lesson-plan';

    public ?array $data = [];

    public ?ModelsLessonPlan $record = null;

    public function mount(): void
    {
        $this->record = ModelsLessonPlan::query()
            ->firstOrNew([
                'school_id' => Filament::getTenant()->id,
            ]);

        abort_unless(static::canView($this->record), 404);

        $this->fillForm();
    }

    public function fillForm(): void
    {
        $data = $this->record->attributesToArray();

        $this->form->fill($data);
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $this->handleRecordUpdate($this->record, $data);
        } catch (Halt $exception) {
            return;
        }

        $this->getSavedNotification()->send();
    }

    protected function getSavedNotification(): Notification
    {
        return Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'));
    }

    public function form(Form $form): Form
    {
        return $form
            ->live()
            ->schema([
                $this->getGeneralSection(),
                $this->getLessonDetailsSection(),
                // $this->getTemplateSection(),
            ])
            ->model($this->record)
            ->statePath('data')
            ->operation('edit');
    }

    protected function getGeneralSection(): Component
    {
        return Section::make('General')
            ->schema([
                Forms\Components\DatePicker::make('date')
                    // ->required()
                    ->default(now()),

                Forms\Components\Select::make('school_id')
                    // ->required()
                    ->disabled()
                    ->relationship(
                        'school',
                        'name',
                    )
                    ->default(Filament::getTenant()->id),

                Forms\Components\Select::make('teacher_id')
                    // ->required()
                    ->disabled()
                    ->relationship('teacher', 'name')
                    ->default(auth()->user()->id),

                Forms\Components\Select::make('subject_id')
                    // ->required()
                    ->relationship('subject', 'name'),

                Forms\Components\Select::make('grade_id')
                    // ->required()
                    ->relationship('grade', 'name'),

                Forms\Components\Select::make('stream_id')
                    // ->required()
                    ->relationship('stream', 'name'),

                Forms\Components\TimePicker::make('start_time')
                    // ->required()
                    ->label('Class Start Time')
                    ->default(now()),

                Forms\Components\TimePicker::make('end_time')
                    // ->required()
                    ->label('Class End Time')
                    ->default(now()->addHour()),
            ])->columns(3);
    }

    protected function getLessonDetailsSection(): Component
    {
        return Section::make('Lesson Details')
            ->schema([
                Forms\Components\Select::make('topic_id')
                    // ->required()
                    ->relationship('topic', 'name'),
                Forms\Components\Select::make('subtopic_id')
                    // ->required()
                    ->relationship('subtopic', 'name'),
                Forms\Components\Select::make('competence_id')
                    // ->required()
                    ->relationship('competence', 'content'),
            ])->columns(3);
    }

    protected function getTemplateSection(): Component
    {
        return Section::make('Template')
            ->description('Choose the template and edit the column names.')
            ->schema([
                Grid::make(1)
                    ->schema([
                        FileUpload::make('logo')
                            ->openable()
                            ->maxSize(1024)
                            ->visibility('public')
                            ->disk('public')
                            ->directory('logos/document')
                            ->imageResizeMode('contain')
                            ->imageCropAspectRatio('3:2')
                            ->panelAspectRatio('3:2')
                            ->panelLayout('integrated')
                            ->removeUploadedFileButtonPosition('center bottom')
                            ->uploadButtonPosition('center bottom')
                            ->uploadProgressIndicatorPosition('center bottom')
                            ->getUploadedFileNameForStorageUsing(
                                static fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                    ->prepend(Filament::getTenant()->id . '_'),
                            )
                            ->extraAttributes([
                                'class' => 'aspect-[3/2] w-[9.375rem] max-w-full',
                            ])
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/gif']),
                        Checkbox::make('show_logo'),
                    ])->columnSpan(1),
                Grid::make()
                    ->schema([
                        ViewField::make('preview.default')
                            ->columnSpan(2)
                            ->hiddenLabel()
                            // ->visible(static fn (callable $get) => $get('template') === 'default')
                            ->view('filament.teacher.components.lp-layouts.default'),
                    ])->columnSpan(2),
            ])->columns(3);
    }

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
            ->submit('save')
            ->keyBindings(['mod+s']);
    }

    public static function canView(Model $record): bool
    {
        try {
            return authorize('update', $record)->allowed();
        } catch (AuthorizationException $exception) {
            return $exception->toResponse()->allowed();
        }
    }
}
