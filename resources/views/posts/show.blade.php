<x-navbar active=""></x-navbar>

<x-layout>
    <x-slot name="title">
    {{ $post->title }}
    </x-slot>

    <x-post :post='$post'></x-post>
    
    <div class="row">
        <div class="col">
            <div class="d-flex p-4">
                <h3>Comments ({{ $post->comments()->count() }})</h3>
            </div>
        </div>
        <div class="col">
            <div class="d-flex p-4 justify-content-center">
                {{ $post->comments()->paginate(10)->links() }}
            </div>
        </div>
        <div class="col"></div>
    </div>
    @foreach ($post->comments()->paginate(10) as $comment)
    <div class="container-fluid p-2 bg-secondary">
        <div class="row" justify-content-md-center>
            <div class="col col-1"></div>
                <div class="col col-10">
                    <div class="row">
                        <x-comment :comment="$comment"></x-comment>
                    </div>
                </div>
            <div class="col col-1"></div>
        </div>
    </div>
    @endforeach<div class="d-flex p-4 justify-content-center">
    {{ $post->comments()->paginate(10)->links() }}
    </div>
    

</x-layout>