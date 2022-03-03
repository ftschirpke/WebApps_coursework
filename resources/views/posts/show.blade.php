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

    <h5>by {{ $post->user->account->display_name }} </h5>
    

    <div class="clearfix">
        @if (!is_null($post->image))
            <img src="{{ asset($post->image) }}" class="img-fluid pt-1 pe-3 pb-3 float-sm-start"/>
        @endif
        <p class="pull-left">{{ $post->message }}</p>
    </div>

</x-layout>