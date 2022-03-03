<x-layout>
    <x-slot name="title">
    {{ $post->title }}
    </x-slot>
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
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
            </a>
            <ul class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </li>
    </x-slot>

    <x-post :post='$post'></x-post>

</x-layout>