<x-navbar active=""/>

<x-app-layout>
    <x-slot name="title">
        Edit a Post
    </x-slot>

    
    <span class="border border-4 bg-dark border-dark rounded text-light">
        <div class="col-md-auto">
            <div class="container-fluid p-4">
                <h1>Edit a Post</h1>
                <form id="editPost" method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="public" type="radio" id="yes" value="1" {{ $post->public ? 'checked' : '' }} required disabled/>
                            <label class="form-check-label" for="public">Public (visible to everyone)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="public" type="radio" id="no" value="0" {{ $post->public ? '' : 'checked' }} required disabled>
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
                        <input class="form-control" id="title" type="text" name="title" placeholder="Title of the Post" value="{{ old('title') ?? $post->title }}" aria-describedby="title_help" required />
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
                        Old Image:
                        @if (is_null($post->image_name))
                            None
                        @else
                            @if (str_starts_with($post->image_name, 'http'))
                            <img src="{{ asset($post->image_name) }}" class="pt-1 pe-3 pb-3"/>
                            @else
                            <img src="{{ asset('storage/post_images/' . $post->image_name) }}" class="pt-1 pe-3 pb-3"/>
                            @endif
                        @endif
                        <br />

                        <div class="form-group mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @change="onChange($event)" name="image_action" type="radio" id="keep" value="keep" required/>
                                <label class="form-check-label" for="image_action">{{ $post->image_name ? 'Keep the old image' : 'Do not add an image' }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @change="onChange($event)" name="image_action" type="radio" id="replace" value="replace" required>
                                <label class="form-check-label" for="image_action">{{ $post->image_name ? 'Replace the old image' : 'Add an image' }}</label>
                            </div>
                            @if ($post->image_name)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" @change="onChange($event)" name="image_action" type="radio" id="delete" value="delete" required>
                                <label class="form-check-label" for="image_action">Delete the old image</label>
                            </div>
                            @endif
                            <br />
                            @error('image_action')
                                <div class="alert alert-danger mt-2 p-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div v-if="replaceImage">
                            New Image: <input class="form-control-file mt-2" id="image" type="file" name="image" value="{{ old('image') }}" aria-describedby="image_help" required>
                            <small class="form-text text-muted" id="image_help">
                            <br />
                            The file must be an image (jpg, jpeg, png, bmp, gif, svg, or webp).
                            </small>
                            @error('image')
                                <div class="alert alert-danger mt-2 p-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <br />
                    </div>
                    <div class="form-group mt-2">
                        <textarea class="form-control textarea-autosize" id="message" rows="15" name="message" placeholder="Message of the Post" aria-describedby="message_help" required/>{{ old('message') ?? $post->message }}</textarea>
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
                        <a href="{{ route('posts.show', ['post' => $post]) }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-warning">Update Post</button>
                    </div>

                </form>
            </div>
        </div>
    </span>

    <script type="text/javascript" src="{{ URL::asset('js/toggle_replace_image_by_radio.js') }}"></script>

</x-app-layout>