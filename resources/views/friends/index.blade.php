<x-navbar active="friends.index"/>
<x-app-layout>
    <span class="border border-4 bg-dark border-dark rounded text-light">  
        <div class="col-md-auto">
            <div class="container-fluid p-4">
                <h1>Friends</h1>
                <br />
                <h3>Find friends</h3>
                <form method="POST" action="{{ route('friends.store') }}" class="row p-2">
                    @csrf
                    <div class="col input-group">
                        <select id="user_id" name="user_id" class="form-control form-select">
                            <option selected>Find a friend</option>
                            @foreach ($user->unrelated_users() as $unrelated_user)
                                <option value="{{ $unrelated_user->id }}">
                                    {{ $unrelated_user->account->display_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('user')
                        <div class="alert alert-danger mt-2 p-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="col-auto">
                        <input type="submit" class="btn btn-warning" value="Send Friend Request"></input>
                    </div>
                </form>
                <br />

                <h3>Received friend requests</h3>
                @foreach ($user->users_friend_requests_received_from->diff($user->friends()) as $user_received_request)
                <div class="row p-2">
                    <div class="col">
                        {{ $user_received_request->account->display_name }}
                    </div>
                    <div class="col-auto">
                        <form method="POST" action="{{ route('friends.store') }}" class="row p-2">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user_received_request->id }}"/>
                            <input type="submit" class="btn btn-warning" value="Accept"></input>
                        </form>
                    </div>
                </div>    
                @endforeach
                <br />

                <h3>Sent friend requests</h3>
                @foreach ($user->users_friend_requests_sent_to->diff($user->friends()) as $user_sent_request)
                <div class="row p-2">
                    <div class="col">
                        {{ $user_sent_request->account->display_name }}
                    </div>
                    <div class="col-auto">
                        <form method="POST"
                            action="{{ route('friends.destroy', ['user' => $user_sent_request]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning" type="submit">Take back</button>
                        </form>
                    </div>
                </div>    
                @endforeach
                <br />

                <h3>My friends</h3>
                @foreach ($user->friends() as $friend)
                <div class="row p-2">
                    <div class="col">
                        {{ $friend->account->display_name }}
                    </div>
                    <div class="col-auto">
                        <form method="POST"
                            action="{{ route('friends.destroy', ['user' => $friend]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning" type="submit">Unfriend</button>
                        </form>
                    </div>
                </div>    
                @endforeach

            </div>
        </div>
    </span>
</x-app-layout>