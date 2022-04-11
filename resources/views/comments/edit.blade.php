<x-navbar active=""/>

<x-app-layout>
    <x-slot name="title">
        Edit a Comment
    </x-slot>
    
    <span class="border border-4 bg-secondary border-dark rounded text-light">
        <div class="col-md-auto">
            <div class="container-fluid p-4">
                <h1>Edit a Comment</h1>
                <form id="editComment" method="POST" action="{{ route('comments.update', ['comment' => $comment]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-2">
                        <textarea class="form-control textarea-autosize" id="message" rows="3" name="message" placeholder="Message of the Comment" aria-describedby="message_help" required
                        />{{ old('message') ?? $comment->message }}</textarea>
                        <small class="form-text text-light" id="message_help">
                            Your comment message must be no more than 1000 characters long.
                        </small>
                        @error('message')
                            <div class="alert alert-danger mt-2 p-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mt-2 text-end">
                        <a href="{{ route('posts.show', ['post' => $comment->post]) }}" class="btn btn-dark me-2">Cancel</a>
                        <button type="submit" class="btn btn-warning">Update Comment</button>
                    </div>

                </form>
            </div>
        </div>
    </span>

    <script type="text/javascript" src="{{ URL::asset('js/toggle_replace_image_by_radio.js') }}"></script>

</x-app-layout>