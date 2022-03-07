<span class="border border-4 bg-dark border-dark rounded text-light">
    <div class="col-md-auto">
        <div class="container-fluid p-4">
            <h1>{{ $post->title ?? 'Post without title' }}</h1>

            <h5>by <a class="text-warning" href="{{ route('account', ['id' => $post->user->id]) }}">
                {{ $post->user->account->display_name }}
            </a></h5>
                
            <div class="clearfix">
                @if (!is_null($post->image))
                    <img src="{{ asset($post->image) }}" class="img-fluid pt-1 pe-3 pb-3 float-sm-start"/>
                @endif
                <p class="pull-left">{{ $post->message }}</p>
            </div>
        </div>
    </div>
</span>