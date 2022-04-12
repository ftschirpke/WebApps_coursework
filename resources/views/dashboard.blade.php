<x-navbar active="dashboard"/>
<x-app-layout>
    <h1>Dashboard</h1>

    <h5>What do you want to do next?</h5>

    <div class="row justify-content-start ms-2 mb-4">
        <div class="col-auto">
            <a href="{{ route('posts.create') }}" class="btn btn-warning">Create a post</a>
        </div>
        <div class="col-auto">
            <a class="btn btn-warning dropdown-toggle" href="{{ route('posts.index') }}" id="navbarDropdown" 
            role="button" data-bs-toggle="dropdown" aria-expanded="false">View Posts</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('posts.index') }}">Public posts</a></li>
                <li><a class="dropdown-item" href="{{ route('posts.indexFriends') }}">My friend's posts</a></li>
                <li><a class="dropdown-item" href="{{ route('posts.indexMy') }}">My posts</a></li>
            </ul>
        </div>
        <div class="col-auto">
            <a href="{{ route('friends.index') }}" class="btn btn-warning">Find Friends</a>
        </div>
    </div>
    
    <h3>Recent activity</h3>

    <div class="p-2 ms-2">
        @if ($recent_activity)
            @if (!empty($recent_activity['new_post_views']))
                <h5>New public posts</h5>
                @foreach ($recent_activity['new_post_views'] as $entry)
                    <div class="row ms-2">
                        <div class="col">
                            Your post 
                            <a href="{{ route('posts.show', ['post' => $entry['post']]) }}"
                            >{{ $entry['post']->title }}</a>
                            was viewed by {{ $entry['count'] }} additional users in the last 24 hours
                            and has {{ $entry['post']->users_viewed_by->count() }}
                            total views now.
                        </div>
                    </div>
                @endforeach
            @endif
            @if ($recent_activity['new_friends']->isNotEmpty())
            <br />
                <h5>New friends</h5>
                @foreach ($recent_activity['new_friends'] as $friend)
                    <div class="row ms-2">
                        <div class="col">
                            You and 
                            <a href="{{ route('accounts.show', ['account' => $friend->account]) }}"
                            >{{ $friend->account->display_name }}</a>
                            are now friends.
                        </div>
                    </div>
                @endforeach
            @endif
            @if ($recent_activity['new_friend_requests']->isNotEmpty())
            <br />
                <h5>New friend requests</h5>
                @foreach ($recent_activity['new_friend_requests'] as $sender)
                    <div class="row ms-2">
                        <div class="col">
                            <a href="{{ route('accounts.show', ['account' => $sender->account]) }}"
                            >{{ $sender->account->display_name }}</a>
                            sent you a friend request.
                            <a href="{{ route('friends.index') }}"
                            >(go to the friends page to accept)</a>
                        </div>
                    </div>
                @endforeach
            @endif
            @if ($recent_activity['friends_posts']->isNotEmpty())
            <br />
                <h5>New posts by your friends</h5>
                @foreach ($recent_activity['friends_posts'] as $friend_post)
                    <div class="row ms-2">
                        <div class="col">
                            Your friend 
                            <a href="{{ route('accounts.show', ['account' => $friend_post->user->account]) }}"
                            >{{ $friend_post->user->account->display_name }}</a>
                            posted
                            <a href="{{ route('posts.show', ['post' => $friend_post]) }}"
                            >'{{ $friend_post->title }}'</a>
                            {{ $friend_post->public ? 'publicly' : 'privately' }}
                            {{ now()->longAbsoluteDiffForHumans($friend_post->created_at) }}
                            ago.
                        </div>
                    </div>
                @endforeach
            @endif
            @if ($recent_activity['public_posts']->isNotEmpty())
            <br />
                <h5>New public posts</h5>
                @foreach ($recent_activity['public_posts'] as $public_post)
                    <div class="row ms-2">
                        <div class="col">
                            The user 
                            <a href="{{ route('accounts.show', ['account' => $public_post->user->account]) }}"
                            >{{ $public_post->user->account->display_name }}</a>
                            posted
                            <a href="{{ route('posts.show', ['post' => $public_post]) }}"
                            >'{{ $public_post->title }}'</a>
                            {{ now()->longAbsoluteDiffForHumans($public_post->created_at) }}
                            ago.
                        </div>
                    </div>
                @endforeach
            @endif



        @else
            <p>No activity in the last 24 hours 😞.</p>
        @endif
    </div>
    



</x-app-layout>
