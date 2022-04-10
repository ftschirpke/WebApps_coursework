<span class="border border-4 bg-dark border-dark rounded text-light">
    <div class="col-md-auto">
        <div class="container-fluid p-4">
            <h1>{{ $post->title ?? 'Post without title' }}</h1>
            @can('delete', $post)
                <x-delete-button type="Post">
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning" type="submit">Yes</button>
                    </form>
                </x-delete-button>
            @endcan
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
                @if (!is_null($post->image_name))
                    @if (str_starts_with($post->image_name, 'http'))
                    <img src="{{ asset($post->image_name) }}" class="img-fluid pt-1 pe-3 pb-3 float-sm-start"/>
                    @else
                    <img src="{{ asset('storage/post_images/' . $post->image_name) }}" class="img-fluid pt-1 pe-3 pb-3 float-sm-start"/>
                    @endif
                @endif
                <p class="pull-left">{!! nl2br(e($post->message)) !!}</p>
                <!-- this converts line breaks to br-tags, such that
                    the text is still nicely formatted -->
            </div>
        </div>
    </div>
</span>