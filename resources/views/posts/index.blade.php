<x-navbar active="posts.index"/>
<x-app-layout>
    <span class="border border-4 bg-dark border-dark rounded text-light">  
        <div class="col-md-auto">
            <div class="container-fluid p-4">
                <h1>List of all posts</h1>
                <div class="row p-1">
                    <div class="col-4">
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Other views
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><form action="{{ route('posts.create') }}">
                                    <button type="submit" class="dropdown-item">All Post</button>
                                </form></li>
                                <li><form action="{{ route('posts.create') }}">
                                    <button type="submit" class="dropdown-item">My Post</button>
                                </form></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-4">
                        {{ $posts->links() }}
                    </div>
                    <div class="col-4 text-end">
                        <form action="{{ route('posts.create') }}">
                            <button type="submit" class="btn btn-warning">Create Post</button>
                        </form>
                    </div>
                </div>
                <ul>
                    @foreach ($posts as $post)
                    <li>
                        <a class="text-warning" href="{{ route('posts.show', $post) }}">
                        {{ $post->title }}</a>
                        by {{ $post->user->account->display_name }}
                        <!-- @if (now()->subWeeks(1)->greaterThan($post->created_at))
                            created at {{ $post->created_at }}
                        @else
                            created
                            {{ now()->longAbsoluteDiffForHumans($post->created_at) }}
                            ago
                        @endif -->
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