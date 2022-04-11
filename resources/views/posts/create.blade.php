<x-navbar active=""/>

<x-app-layout>
    <x-slot name="title">
        Create a Post
    </x-slot>

    
    <span class="border border-4 bg-dark border-dark rounded text-light">
        <div class="col-md-auto">
            <div class="container-fluid p-4">
                <h1>Create a Post</h1>
                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="public" type="radio" id="yes" value="1" {{ old('public') ? 'checked' : '' }} required/>
                            <label class="form-check-label" for="public">Public (visible to everyone even guests)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="public" type="radio" id="no" value="0" {{ old('public') ? '' : 'checked' }} required>
                            <label class="form-check-label" for="private">Private (visible to friends only)</label>
                        </div>
                        <br />
                        <small class="form-text text-muted" id="public_help">
                        This setting cannot be changed.
                        </small>
                        @error('public')
                            <div class="alert alert-danger mt-2 p-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <input class="form-control" id="title" type="text" name="title" placeholder="Title of the Post" value="{{ old('title') }}" aria-describedby="title_help" required autofocus />
                        <small class="form-text text-muted" id="title_help">
                        Your post title must be no more than 60 characters long.
                        </small>
                        @error('title')
                            <div class="alert alert-danger mt-2 p-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <input class="form-control-file" id="image" type="file" name="image" value="{{ old('image') }} aria-describedby="image_help">
                        <small class="form-text text-muted" id="image_help">
                        The file must be an image (jpg, jpeg, png, bmp, gif, svg, or webp).
                        </small>
                        @error('image')
                            <div class="alert alert-danger mt-2 p-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <textarea class="form-control textarea-autosize" id="message" rows="15" name="message" placeholder="Message of the Post" aria-describedby="message_help" required autofocus/>{{ old('message') }}</textarea>
                        <small class="form-text text-muted" id="message_help">
                        Your post message must be no more than 5000 characters long.
                        </small>
                        @error('message')
                            <div class="alert alert-danger mt-2 p-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mt-2 text-end">
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning">Create Post</button>
                    </div>

                </form>
            </div>
        </div>
    </span>

</x-app-layout>