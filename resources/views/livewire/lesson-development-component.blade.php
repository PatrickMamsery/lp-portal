<div class="p-4">
    <div class="flex flex-col">
        <!-- Preview Section -->
        <div class="w-full p-2">
            <h2 class="font-semibold text-lg mb-4">Lesson Stages Preview</h2>
            <table class="min-w-full bg-white my-2">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Stage</th>
                        <th class="py-3 px-6 text-left">Time (min)</th>
                        <th class="py-3 px-6 text-left">Teaching Activities</th>
                        <th class="py-3 px-6 text-left">Learning Activities</th>
                        <th class="py-3 px-6 text-left">Assessment</th>
                        <th class="py-3 px-6 text-left" style="background-color: black; color:aliceblue">Aaction</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @if ($lessonStages == null)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">INTRODUCTION</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"
                                style="background-color: black; color:aliceblue">
                                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" wire:click="populateForm('INTRODUCTION')"
                                type="button">
                                Toggle modal
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">DEVELOPING NEW KNOWLEDGE</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"
                                style="background-color: black; color:aliceblue">add</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">REINFORCEMENT</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"
                                style="background-color: black; color:aliceblue">add</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">REFLECTION</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"
                                style="background-color: black; color:aliceblue">add</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">ASSESSMENT</td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"></td>
                            <td class="py-3 px-6 text-left whitespace-nowrap"
                                style="background-color: black; color:aliceblue">add</td>
                        </tr>
                    @else
                        @foreach ($lessonStages as $index => $stage)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $stage->name }}</td>
                                <td class="py-3 px-6 text-left">{{ $stage->time }}</td>
                                <td class="py-3 px-6 text-left">{{ $stage->teaching_activities }}</td>
                                <td class="py-3 px-6 text-left">{{ $stage->learning_activities }}</td>
                                <td class="py-3 px-6 text-left">{{ $stage->assessment }}</td>
                                <td class="py-3 px-6 text-left whitespace-nowrap"
                                style="background-color: black; color:aliceblue">
                                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" wire:click="populateForm('INTRODUCTION')"
                                type="button">
                                Toggle modal
                                </button>
                            </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <button wire:click="downloadLessonStages" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">
                Download Lesson Stages
            </button>

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
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>




    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="">
                    @livewire('stage-form-component')
                </div>
            </div>
        </div>
    </div>


</div>
