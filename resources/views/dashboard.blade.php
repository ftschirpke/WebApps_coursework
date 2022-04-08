<x-navbar active="dashboard"/>
<x-app-layout>
    <h1>Dashboard</h1>
    
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div class="form-group p-2">
            <button type="submit" class="btn btn-warning">Call of Duty API</button>
        </div>

    </form>

    
    <a href="{{ route('api.test') }}">link</a>
    <a href="{{ route('api.posts.show', ['post' => \App\Models\Post::find(1)]) }}">link2</a>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
            
</x-app-layout>
