<div class="p-4">
    <div class="flex flex-col md:flex-row">
        <!-- Preview Section -->
        <div class="w-full md:w-2/3 p-2">
            <h2 class="font-semibold text-lg mb-4">Lesson Stages Preview</h2>
            <table class="min-w-full bg-white my-2">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Stage</th>
                        <th class="py-3 px-6 text-left">Time</th>
                        <th class="py-3 px-6 text-left">Teaching Activities</th>
                        <th class="py-3 px-6 text-left">Learning Activities</th>
                        <th class="py-3 px-6 text-left">Assessment</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($lessonStages as $index => $stage)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $stage['stage'] }}</td>
                            <td class="py-3 px-6 text-left">{{ $stage['time'] }}</td>
                            <td class="py-3 px-6 text-left">{{ $stage['teachingActivities'] }}</td>
                            <td class="py-3 px-6 text-left">{{ $stage['learningActivities'] }}</td>
                            <td class="py-3 px-6 text-left">{{ $stage['assessment'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h2 class="font-semibold text-lg mt-4 mb-2">Evaluations Preview</h2>
            <div class="my-4">
                <h3 class="font-semibold text-lg">Students' Evaluation</h3>
                <p>{{ $studentEvaluation }}</p>
            </div>

            <div class="my-4">
                <h3 class="font-semibold text-lg">Teacher's Evaluation</h3>
                <p>{{ $teacherEvaluation }}</p>
            </div>

            <div class="my-4">
                <h3 class="font-semibold text-lg">Remarks</h3>
                <p>{{ $remarks }}</p>
            </div>

            <div class="mt-4">
                <button class="px-4 py-2 bg-blue-500 text-white rounded" wire:click="save">Save</button>
            </div>
        </div>

        <!-- Input Form Section -->
        <div class="w-full md:w-1/3 p-2">
            <h2 class="font-semibold text-lg mb-4">Add New Lesson Stage</h2>
            <div class="my-4">
                <label class="block text-gray-700">Stage</label>
                <input wire:model="newStage.stage" class="block w-full bg-white px-3 py-1.5 text-base text-gray-950 border border-gray-300 rounded" type="text">
            </div>

            <div class="my-4">
                <label class="block text-gray-700">Time</label>
                <input wire:model="newStage.time" class="block w-full bg-white px-3 py-1.5 text-base text-gray-950 border border-gray-300 rounded" type="text">
            </div>

            <div class="my-4">
                <label class="block text-gray-700">Teaching Activities</label>
                <textarea wire:model="newStage.teachingActivities" class="block w-full bg-white px-3 py-1.5 text-base text-gray-950 border border-gray-300 rounded"></textarea>
            </div>

            <div class="my-4">
                <label class="block text-gray-700">Learning Activities</label>
                <textarea wire:model="newStage.learningActivities" class="block w-full bg-white px-3 py-1.5 text-base text-gray-950 border border-gray-300 rounded"></textarea>
            </div>

            <div class="my-4">
                <label class="block text-gray-700">Assessment</label>
                <textarea wire:model="newStage.assessment" class="block w-full bg-white px-3 py-1.5 text-base text-gray-950 border border-gray-300 rounded"></textarea>
            </div>

            <div class="mt-4">
                <button class="px-4 py-2 bg-green-500 text-white rounded" wire:click="addLessonStage">Add Stage</button>
            </div>

            <h2 class="font-semibold text-lg mt-4 mb-4">Evaluations Input</h2>
            <div class="my-4">
                <label class="block text-gray-700">Students' Evaluation</label>
                <textarea wire:model="studentEvaluation" class="block w-full bg-white px-3 py-1.5 text-base text-gray-950 border border-gray-300 rounded"></textarea>
            </div>

            <div class="my-4">
                <label class="block text-gray-700">Teacher's Evaluation</label>
                <textarea wire:model="teacherEvaluation" class="block w-full bg-white px-3 py-1.5 text-base text-gray-950 border border-gray-300 rounded"></textarea>
            </div>

            <div class="my-4">
                <label class="block text-gray-700">Remarks</label>
                <textarea wire:model="remarks" class="block w-full bg-white px-3 py-1.5 text-base text-gray-950 border border-gray-300 rounded"></textarea>
            </div>
        </div>
    </div>
</div>
