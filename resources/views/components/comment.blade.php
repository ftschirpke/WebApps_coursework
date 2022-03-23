<span class="border border-4 bg-secondary border-dark rounded text-light">
    <div class="col">
        <div class="container-fluid p-4">
            <h6>by <a class="text-warning" href="{{ route('accounts.show', ['account' => $comment->user->account]) }}">
                {{ $comment->user->account->display_name }}
            </a></h6>
            
            <div class="clearfix">
                <p class="pull-left">{!! nl2br(e($comment->message)) !!}</p>
                <!-- this converts line breaks to br-tags, such that
                    the text is still nicely formatted -->
            </div>
        </div>
    </div>
</span>