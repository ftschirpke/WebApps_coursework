<!doctype html>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top border-bottom border-2 border-warning">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Postnint</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    @if ($active == 'dashboard')
                        <a class="nav-link active" aria-current="page" href="">Dashboard</a>
                    @else
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    @endif
                </li>
                @guest
                    <li class="nav-item">
                        @if ($active == 'posts.index')
                            <a class="nav-link active" aria-current="page" href="">Posts</a>
                        @else
                            <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                        @endif
                    </li>
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('posts.index') }}" id="navbarDropdown" 
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Posts
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('posts.index') }}">Public posts</a></li>
                            <li><a class="dropdown-item" href="{{ route('posts.indexFriends') }}">My friend's posts</a></li>
                            <li><a class="dropdown-item" href="{{ route('posts.indexMy') }}">My posts</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        @if ($active == 'friends.index')
                        <a class="nav-link active" aria-current="page" href="">Friends</a>
                        @else
                        <a class="nav-link" href="{{ route('friends.index') }}">Friends</a>
                        @endif
                    </li>
                    @if (Auth::user()->is_admin)
                        <li class="nav-item">
                            @if ($active == 'reports.index')
                            <a class="nav-link active" aria-current="page" href="">Reports</a>
                            @else
                            <a class="nav-link" href="{{ route('reports.index') }}">Reports</a>
                            @endif
                        </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        @if ($active == 'accounts.show')
                            <a class="nav-link active" aria-current="page" href="">My Account</a>
                        @else
                            <a class="nav-link" href="{{ route('accounts.show', ['account' => Auth::user()->account]) }}">My Account</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if ($active == 'settings')
                            <a class="nav-link active" aria-current="page" href="{{ route('settings') }}">Settings</a>
                        @else
                            <a class="nav-link" href="{{ route('settings') }}">Settings</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="nav-link" href="#"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                            >Logout
                            </a>
                        </form>
                        
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        @if ($active == 'login')
                            <a class="nav-link active" aria-current="page" href="">Log in</a>
                        @else
                            <a class="nav-link" href="{{ route('login') }}">Log in</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if ($active == 'register')
                            <a class="nav-link active" aria-current="page" href="">Register</a>
                        @else
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        @endif
                    </li>
                @endguest
            </ul>
        </div>
        </div>
</nav>