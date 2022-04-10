<span class="border border-4 bg-dark border-warning rounded text-light">
    <div class="col-md-auto">
        <div class="container-fluid p-4">
            <h1>{{ 'Report ' . $report->id }}</h1>
            <div class="row mb-2">
                <div class="col-5">
                    <h5>Reported 
                        @if ($report->reportable_type == 'App\Models\Post')
                        <a class="text-warning" href="{{ route('posts.show', ['post' => $report->reportable]) }}">
                            {{ 'Post ' . $report->reportable->id }}</a>
                        @elseif ($report->reportable_type == 'App\Models\Comment')
                        <a class="text-warning" href="{{ route('posts.show', ['post' => $report->reportable->post]) }}">
                            {{ 'Comment ' . $report->reportable->id }}
                        </a>
                        @endif
                        by
                        <a class="text-warning" href="{{ route('accounts.show', ['account' => $report->user->account]) }}">
                            {{ $report->user->account->display_name }}
                        </a>
                    </h5>
                </div>
                <div class="col-7 text-end">
                    Created on {{ $report->created_at }}
                </div>

            </div>
            <p class="pull-left">{!! nl2br(e($report->message)) !!}</p>
            <!-- this converts line breaks to br-tags, such that
                the text is still nicely formatted -->
                
        </div>
    </div>
</span>