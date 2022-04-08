<x-navbar active=""/>

<x-app-layout>
    <x-slot name="title">
    {{ $post->title }}
    </x-slot>

    <x-post :post='$post'></x-post>
    
    <!-- <h3>Comments</h3> -->
    <div class="d-flex p-4 justify-content-center">
        {{ $comments->links() }}
    </div>

    <div id="cc">
        @foreach ($comments as $comment)
        <div class="container-fluid p-2 bg-secondary">
            <div class="row" justify-content-md-center>
                <div class="col col-1"></div>
                <div class="col col-10">
                    <div class="row">
                        <x-comment :comment="$comment"></x-comment>
                    </div>
                </div>
                <div class="col col-1"></div>
            </div>
        </div>
        @endforeach
        <div v-if="cc" class="container-fluid p-2 bg-secondary">
            <ul>
                <li v-for="comment in comments">@{{ comment.message }}</li>
            </ul>
            <div class="row" justify-content-md-center>
                <div class="col col-1"></div>
                <div class="col col-10">
                    <div class="row">
                        <span v-if="cc" class="border border-4 bg-secondary border-dark rounded text-light">
                            <div class="col">
                                <div class="container-fluid p-4">
                                    <h3>Create a Comment</h3>
                                    <form method="POST" action="#">
                                        @csrf
                                        <div class="form-group p-2">
                                            <textarea class="form-control textarea-autosize" id="message" rows="3" name="message" placeholder="Message of the Post" aria-describedby="message_help" required autofocus/>{{ old('message') }}</textarea>
                                            <small class="form-text text-light" id="message_help">
                                                Your post message must be no more than 1000 characters long.
                                            </small>
                                            @error('message')
                                            <div class="alert alert-danger mt-2 p-2">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group text-center">
                                            <button @click="cc = false" class="btn btn-warning me-2">Cancel</button>
                                            <button type="submit" class="btn btn-warning ms-2">Create Post</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="col col-1"></div>
            </div>
            <div class="row" justify-content-md-center>
                <div class="col col-1"></div>
                <div class="col col-10">
                    <div class="d-flex p-2 justify-content-center">
                        @if ($comments->hasMorePages())
                        <a href="{{ $comments->url($comments->lastPage()) . '&cc=true' . '#' . $comments->lastItem() }}" class="btn btn-warning" role="button">Create Comment</a>
                        @else
                        <button v-if="!cc" @click="cc = true" type="submit" class="btn btn-warning">Create Comment</button>
                        @endif
                    </div>
                </div>
                <div class="col col-1"></div>
                {{ route('api.posts.show', ['post'=>$post]) }}
            </div>
        </div>
        <div class="d-flex p-4 justify-content-center">
            {{ $comments->links() }}
        </div>
    </div>

    <script>
        const bladeParams = {
            comments_pagination: JSON.parse(he.decode("{{ $comments->toJson() }}"))
        };
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/comments.create.js') }}"></script>

</x-app-layout>