<x-navbar active="all_posts"></x-navbar>
<x-layout>
    <span class="border border-4 bg-dark border-dark rounded text-light">
        <div class="col-md-auto">
            <div class="container-fluid p-4">
                <h1>List of all posts</h1>
                @foreach ($posts as $post)
                    <li>{{ $post->title }}</li>
                @endforeach
            </div>
        </div>
    </span>
</x-layout>