<x-navbar active="posts.indexMy"/>
<x-app-layout>
    <span class="border border-4 bg-dark border-dark rounded text-light">  
        <div class="col-md-auto">
            <div class="container-fluid p-4">
                <h1>List of all {{ $descr }} posts</h1>
                <div class="row p-1 mb-2">
                    <div class="col-4">
                        @auth
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Other views
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                @if ($descr != 'public')
                                <li>
                                    <a href="{{ route('posts.indexFriends') }}" class="dropdown-item">Public Posts</a>
                                </li>
                                @endif
                                @if ($descr != 'my friend\'s')
                                <li>
                                    <a href="{{ route('posts.indexFriends') }}" class="dropdown-item">Friends Posts</a>
                                </li>
                                @endif
                                @if ($descr != 'my')
                                <li>
                                    <a href="{{ route('posts.indexMy') }}" class="dropdown-item">My Posts</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        @endauth
                    </div>
                    <div class="col-4">
                        {{ $posts->links() }}
                    </div>
                    <div class="col-4 text-end">
                        <a href="{{ route('posts.create') }}" class="btn btn-warning">Create Post</a>
                    </div>
                </div>
                <ul>
                    @foreach ($posts as $post)
                    <li>
                        <a class="text-warning" href="{{ route('posts.show', $post) }}">
                        {{ $post->title }}</a>
                        by {{ $post->user->account->display_name }}
                    </li>
                    @endforeach
                </ul>
                <div class="d-flex p-1 justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </span>
</x-app-layout>