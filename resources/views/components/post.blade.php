<span class="border border-4 bg-dark border-dark rounded text-light">
    <div class="col-md-auto">
        <div class="container-fluid p-4">
            <h1>{{ $post->title ?? 'Post without title' }}</h1>
            
            <div class="row mb-2">
                <div class="col-5">
                    <h5>{{ $post->public ? "Public Post" : "Private Post" }} by 
                        <a class="text-warning" href="{{ route('accounts.show', ['account' => $post->user->account]) }}">
                            {{ $post->user->account->display_name }}
                        </a>
                    </h5>
                </div>
                <div class="col-7 text-end">
                    Created on {{ $post->created_at; }}
                    @if ( $post->updated_at != $post->created_at )
                    and Updated on {{ $post->updated_at; }}
                    @endif
                </div>
            </div>
                
            <div class="clearfix">
                @if (!is_null($post->image))
                    <img src="{{ asset($post->image) }}" class="img-fluid pt-1 pe-3 pb-3 float-sm-start"/>
                @endif
                <p class="pull-left">{!! nl2br(e($post->message)) !!}</p>
                <!-- this converts line breaks to br-tags, such that
                    the text is still nicely formatted -->
            </div>
        </div>
    </div>
</span>