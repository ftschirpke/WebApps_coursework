<x-navbar active="posts.index"/>
<x-app-layout>
    <span class="border border-4 bg-dark border-dark rounded text-light">  
        <div class="col-md-auto">
            <div class="container-fluid p-4">
                <h1>List of all posts</h1>
                <a href="{{ route('posts.create') }}">Create Post</a>
                @foreach ($posts as $post)
                    <li>
                        <a class="text-warning" href="{{ route('posts.show', $post) }}">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
            </div>
        </div>
    </span>
</x-app-layout>