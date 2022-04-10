<x-navbar active="reports.index"/>
<x-app-layout>
    <span class="border border-4 bg-dark border-dark rounded text-light">  
        <div class="col-md-auto">
            <div class="container-fluid p-4">
                <h1>List of all reports</h1>
                <div class="d-flex p-1 justify-content-center">
                    {{ $reports->links() }}
                </div>
                <ul>
                    @foreach ($reports as $report)
                        <li>
                            <a class="text-warning" href="{{ route('reports.show', ['report'=>$report]) }}">
                                {{ 'Report ' .  $report->id . ': ' 
                                    . $report->reportable_type . ' '
                                    . $report->reportable_id . ' reported by User '
                                    . $report->user_id . '('
                                    . $report->user->account->display_name
                                    . ') for reason: ' . $report->category }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="d-flex p-1 justify-content-center">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </span>
</x-app-layout>