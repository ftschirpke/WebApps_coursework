<!doctype html>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Coursework</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    @if ($active == 'home')
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    @else
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if ($active == 'posts.index')
                        <a class="nav-link active" aria-current="page" href="{{ route('posts.index') }}">Posts</a>
                    @else
                        <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                    @endif
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    @if ($active == 'account')
                        <a class="nav-link active" aria-current="page" href="{{ route('posts.index') }}">My Account</a>
                    @else
                        <a class="nav-link" href="{{ route('account', ['id' => 1]) }}">My Account</a>
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
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
        </div>
</nav>