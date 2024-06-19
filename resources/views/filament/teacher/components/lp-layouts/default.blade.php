@php
    $data = $this->form->getRawState();
    $viewModel = new \App\View\Models\LessonPlanViewModel($this->record, $data);
    $viewSpecial = $viewModel->buildViewData();
    extract($viewSpecial,\EXTR_SKIP);
@endphp

{{-- {!! $font_html !!} --}}

<style>
    .inv-paper {
        font-family: 'Poppins', sans-serif;
    }
</style>

<x-school.lessonplan.container class="default-template-container">

    <x-school.lessonplan.header class="default-template-header border-b-2 p-6 pb-4">
        <div class="w-2/3">
            {{-- <h1 class="text-2xl font-semibold">Logo</h1> --}}
            @if($logo && $show_logo)
                <x-school.lessonplan.logo :src="$logo"/>
            @endif
        </div>

        <div class="w-1/3 text-right">
            <div class="text-xs">
                <h2 class="font-semibold">{{ $school_name }}</h2>
                @if($school_region && $school_district && $school_ward)
                    <p>{{ $school_region }}</p>
                    <p>{{ $school_district }}</p>
                    <p>{{ $school_ward }}</p>
                @endif
            </div>
        </div>
    </x-school.lessonplan.header>

    <x-school.lessonplan.generalsection class="default-template-metadata space-y-6">
        <div>
            <h1 class="text-3xl font-light uppercase">{{ $header }}</h1>
            {{-- @if ($subheader)
                <h2 class="text-sm text-gray-600 dark:text-gray-400">{{ $subheader }}</h2>
            @endif --}}
        </div>
        <div class="flex justify-between items-end">
            <div class="text-xs">
                <h3 class="text-gray-600 dark:text-gray-400 font-medium tracking-tight mb-1">PRELIMINARY DATA</h3>
                <p class="text-base font-bold">{{ $teacher_name }}</p>
                <p>123 Main Street</p>
                <p>New York, New York 10001</p>
                <p>United States</p>
            </div>

            <div class="text-xs">
                <table class="min-w-full">
                    <tbody>
                    <tr>
                        <td class="font-semibold text-right pr-2">Data:</td>
                        <td class="text-left pl-2">1</td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-right pr-2">Data:</td>
                        <td class="text-left pl-2">here</td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-right pr-2">Data:</td>
                        <td class="text-left pl-2">now</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </x-school.lessonplan.generalsection>

    <!-- Line Items Table -->
    <x-school.lessonplan.line-items class="default-template-line-items">
        <table class="w-full text-left table-fixed">
            <thead class="text-sm leading-8" style="background: black">
            <tr class="text-white">
                <th class="text-left pl-6">Items</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Price</th>
                <th class="text-right pr-6">Amount</th>
            </tr>
            </thead>
            <tbody class="text-xs border-b-2 border-gray-300 leading-8">
            <tr>
                <td class="text-left pl-6 font-semibold">Item 1</td>
                <td class="text-center">2</td>
                <td class="text-right">$150.00</td>
                <td class="text-right pr-6">$300.00</td>
            </tr>
            <tr>
                <td class="text-left pl-6 font-semibold">Item 2</td>
                <td class="text-center">3</td>
                <td class="text-right">$200.00</td>
                <td class="text-right pr-6">$600.00</td>
            </tr>
            <tr>
                <td class="text-left pl-6 font-semibold">Item 3</td>
                <td class="text-center">1</td>
                <td class="text-right">$180.00</td>
                <td class="text-right pr-6">$180.00</td>
            </tr>
            </tbody>
            <tfoot class="text-xs leading-loose">
            <tr>
                <td class="pl-6" colspan="2"></td>
                <td class="text-right font-semibold">Subtotal:</td>
                <td class="text-right pr-6">$1080.00</td>
            </tr>
            <tr class="text-success-800 dark:text-success-600">
                <td class="pl-6" colspan="2"></td>
                <td class="text-right">Discount (5%):</td>
                <td class="text-right pr-6">($54.00)</td>
            </tr>
            <tr>
                <td class="pl-6" colspan="2"></td>
                <td class="text-right">Sales Tax (10%):</td>
                <td class="text-right pr-6">$102.60</td>
            </tr>
            <tr>
                <td class="pl-6" colspan="2"></td>
                <td class="text-right font-semibold border-t">Total:</td>
                <td class="text-right border-t pr-6">$1128.60</td>
            </tr>
            <tr>
                <td class="pl-6" colspan="2"></td>
                <td class="text-right font-semibold border-t-4 border-double">Amount Due (USD):</td>
                <td class="text-right border-t-4 border-double pr-6">$1128.60</td>
            </tr>
            </tfoot>
        </table>
    </x-school.lessonplan.line-items>

    <!-- Footer Notes -->
    <x-school.lessonplan.footer class="default-template-footer">
        <p class="px-6">Footer</p>
        <span class="border-t-2 my-2 border-gray-300 block w-full"></span>
        <h4 class="font-semibold px-6 mb-2">Terms & Conditions</h4>
        <p class="px-6 break-words line-clamp-4">Terms</p>
    </x-school.lessonplan.footer>

</x-school.lessonplan.container>


{{-- <table class="w-full text-left table-fixed">
            <thead class="text-sm leading-8" style="background: green">
                <tr class="text-white">
                    <th class="text-left pl-6">Date</th>
                    <th class="text-center">Class</th>
                    <th class="text-right">Period</th>
                    <th class="text-right pr-6">Time</th>
                </tr>
            </thead>
            <tbody class="text-xs border-b-2 border-gray-300 leading-8">
                <tr>
                    <td class="text-left pl-6 font-semibold">Item 1</td>
                    <td class="text-center">2</td>
                    <td class="text-right">$150.00</td>
                    <td class="text-right pr-6">$300.00</td>
                </tr>
            </tbody>
        </table> --}}
