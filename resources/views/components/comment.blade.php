<span class="border border-4 bg-secondary border-dark rounded text-light">
    <div class="col">
        <div class="container-fluid p-4">
            <h6>by <a class="text-warning" href="{{ route('account', ['id' => $comment->user->id]) }}">
                {{ $comment->user->account->display_name }}
            </a></h6>
            
            <div class="clearfix">
                <p class="pull-left">{{ $comment->message }}</p>
            </div>
        </div>
    </div>
</span>