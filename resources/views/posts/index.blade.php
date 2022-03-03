<x-layout>
    <x-slot name="navbar_slot">
        <li class="nav-item">
            <a class="nav-link active" href="/posts">Posts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Something</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">else</a>
        </li>
    </x-slot>
    @foreach ($posts as $post)
        <li>{{ $post->title }}</li>
    @endforeach
</x-layout>