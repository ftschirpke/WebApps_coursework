<div class="container-fluid p-4">
    <h1>{{ $post->title ?? 'Post without title' }}</h1>

    <h5>by {{ $post->user->account->display_name }} </h5>
        
    <div class="clearfix">
        @if (!is_null($post->image))
            <img src="{{ asset($post->image) }}" class="img-fluid pt-1 pe-3 pb-3 float-sm-start"/>
        @endif
        <p class="pull-left">{{ $post->message }}</p>
    </div>
</div>