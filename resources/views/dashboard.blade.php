<x-navbar active="dashboard"/>
<x-app-layout>
    <h1>Dashboard</h1>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div class="form-group p-2">
            <button type="submit" class="btn btn-warning">Call of Duty API</button>
        </div>

    </form>
    
</x-app-layout>
