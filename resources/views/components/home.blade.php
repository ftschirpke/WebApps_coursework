<x-navbar active="home"/>
<x-app-layout>
    <h1>Home</h1>
    
    @guest
        <p>
            <strong>Welcome to Postnint!</strong>
        </p>
        <p>
            Get started by <a href="{{ route('register') }}">creating an account</a>
            or <a href="{{ route('login') }}">log in</a> if you already have an account.
        </p>
        <p>
            Alternatively, you can have a look at all the <a href="{{ route('posts.index') }}">public posts</a>.
        </p>
    @endguest

    @auth
        <p>
            <strong>Welcome back to Postnint!</strong>
        </p>
        <p>
            Have a look at your <a href="{{ route('dashboard') }}">dashboard</a> 
            to have an overview over everything you can do or just get started
            by <a href="{{ route('posts.create') }}">creating a post</a>.
        </p>
    @endauth
    
    
    
</x-app-layout>