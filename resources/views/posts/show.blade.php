<x-navbar active=""/>

<x-app-layout>
    <x-slot name="title">
    {{ $post->title }}
    </x-slot>

    <x-post :post='$post'></x-post>
    
    @guest
    <div class="container-fluid p-2 bg-secondary">
        <div class="row" justify-content-md-center>
            <div class="col col-1"></div>
            <div class="col col-10">
                <div class="row">
                    <div class="col">
                        <div class="container-fluid p-4 text-center">
                            <h4>To see and create comments, log in:</h4>
                            <form action="{{ route('login') }}">
                                <button type="submit" class="btn btn-warning ms-2">Log in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-1"></div>
        </div>
    </div>
    @endguest
    @auth
    <div id="commentManagement">
        <div class="container-fluid p-2 bg-secondary">
            <div class="row" justify-content-md-center>
                <div class="col col-1"></div>
                <div class="col col-10">
                    <div class="row">
                        <span class="border border-4 bg-secondary border-dark rounded text-light">
                            <div class="col">
                                <div class="container-fluid p-4">
                                    <h3>Create a Comment</h3>
                                    <form @submit.prevent="createComment">
                                        @csrf
                                        <div class="form-group p-2">
                                            <textarea class="form-control textarea-autosize" id="message" rows="3" 
                                                name="message" placeholder="Message of the Comment"
                                                aria-describedby="message_help" required
                                            />{{ old('message') }}</textarea>
                                            <small class="form-text text-light" id="message_help">
                                                Your comment message must be no more than 1000 characters long.
                                            </small>
                                            @error('message')
                                            <div class="alert alert-danger mt-2 p-2">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-warning ms-2">Create Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="col col-1"></div>
            </div>
        </div>
        <div v-for="comment in comments" class="container-fluid p-2 bg-secondary">
            <div class="row" justify-content-md-center>
                <div class="col col-1"></div>
                <div class="col col-10">
                    <div class="row">
                        <span class="border border-4 bg-secondary border-dark rounded text-light">
                            <div class="col">
                                <div class="container-fluid p-4">
                                    <h6>by <a class="text-warning" :href="comment.accountRoute">
                                        @{{ comment.accountDisplayName }}
                                    </a></h6>
                                    
                                    <div class="clearfix">
                                        <p class="pull-left">
                                            <pre>@{{ comment.message }}</pre>
                                        </p>
                                        <!-- this converts line breaks to br-tags, such that
                                        the text is still nicely formatted -->
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="col col-1"></div>
            </div>
        </div>
    </div>
    @endauth

    <script>
        const bladeParams = {
            userId: "{{ Auth::id() }}",
            postId: "{{ $post->id }}",
            postRoute: "{{ route('api.posts.show', ['post'=>$post, 'offset' => 'offset_value']) }}",
            commentsStoreRoute: "{{ route('api.comments.store') }}"
        };
        </script>
    <script type="text/javascript" src="{{ URL::asset('js/comments.create.js') }}"></script>
    
</x-app-layout>