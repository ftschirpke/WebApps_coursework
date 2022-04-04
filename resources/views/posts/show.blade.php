<x-navbar active=""/>

<x-app-layout>
    <x-slot name="title">
    {{ $post->title }}
    </x-slot>

    <x-post :post='$post'></x-post>
    
    <!-- <h3>Comments</h3> -->
    <div class="d-flex p-4 justify-content-center">
        {{ $comments->links() }}
    </div>
    @foreach ($comments as $comment)
    <div class="container-fluid p-2 bg-secondary">
        <div class="row" justify-content-md-center>
            <div class="col col-1"></div>
                <div class="col col-10">
                    <div class="row">
                        <x-comment :comment='$comment'></x-comment>
                    </div>
                </div>
            <div class="col col-1"></div>
        </div>
    </div>
    @endforeach
    @if (!$comments->hasMorePages())
        <div class="container-fluid p-2 bg-secondary">
            <div class="row" justify-content-md-center>
                <div class="col col-1"></div>
                    <div class="col col-10">
                        <div class="d-flex p-1 justify-content-center">
                            <button type="submit" class="btn btn-warning">Create Comment</button>
                        </div>
                    </div>
                <div class="col col-1"></div>
            </div>
        </div>    
    @endif
    <div class="d-flex p-4 justify-content-center">
        {{ $post->comments()->paginate(10) }}
    </div>

</x-app-layout>