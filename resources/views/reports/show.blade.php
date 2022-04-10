<x-navbar active=""/>

<x-app-layout>
    <x-slot name="title">
    {{ 'Report ' . $report->id }}
    </x-slot>

    <x-report :report='$report'></x-report>

    <div class="mt-4 mb-4">
    <h3>Reported {{ substr($report->reportable_type, 11) }}:</h3>
    </div>

    @if ($report->reportable_type == 'App\Models\Post')
    <x-post :post='$report->reportable'></x-post>
    @elseif ($report->reportable_type == 'App\Models\Comment')
    <x-comment :comment='$report->reportable'></x-comment>
    @endif
    
</x-app-layout>