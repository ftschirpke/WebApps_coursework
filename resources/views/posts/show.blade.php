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
                            <a href="{{ route('login') }}" class="btn btn-warning ms-2">Log in</a>
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
                                        <div class="form-group">
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
                                        <div class="form-group text-end">
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
                                    <div class="row mb-2 mt-1">
                                        <div class="col text-start">
                                            <h6>by <a class="text-warning" :href="comment.accountRoute">
                                                @{{ comment.accountDisplayName }}
                                            </a></h6>
                                        </div>
                                        <div class="col text-end">
                                            @{{ comment.created_at }}
                                            <span v-if="comment.updated_at != 'not updated'">
                                            and @{{ comment.updated_at }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="clearfix">
                                        <p class="pull-left">
                                            <pre>@{{ comment.message }}</pre>
                                        </p>
                                        <!-- this converts line breaks to br-tags, such that
                                        the text is still nicely formatted -->
                                    </div>
                                    <div class="row">
                                        <div class="col text-start">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal"
                                                data-bs-target="#reportCommentModal">
                                                Report
                                            </button>
                                        </div>
                                        <div v-if="comment.user_id == authUserId || authUserIsAdmin" class="col text-end">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                :data-bs-target="'#deleteCommentModal' + comment.id">
                                                Delete Comment
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="reportCommentModal" tabindex="-1" 
                                        aria-labelledby="reportCommentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reportCommentModalLabel"
                                                        >Report Comment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Cancel"></button>
                                                </div>
                                                <form method="POST"
                                                    action="{{ route('reports.store') }}">
                                                    @csrf
                                                <div class="modal-body">
                                                    <div class="form-group p-2">
                                                        @foreach (App\Models\Report::$categories as $category)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" name="category" 
                                                                type="radio" id="yes" 
                                                                value="{{ $category }}" {{ old('category') == $category ? 'checked' : '' }} required/>
                                                            <label class="form-check-label" for="category">{{ $category }}</label>
                                                        </div>
                                                        @endforeach
                                                        @error('$category')
                                                        <div class="alert alert-danger mt-2 p-2">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group p-2">
                                                        <textarea class="form-control textarea-autosize" id="report_message" 
                                                            rows="5" name="report_message"
                                                        placeholder="Add a short description" aria-describedby="report_message_help" 
                                                            required autofocus
                                                        />{{ old('report_message') }}</textarea>
                                                        <small class="form-text text-light" id="message_help">
                                                            Your report message must be no more than 1000 characters long.
                                                        </small>
                                                        @error('report_message')
                                                        <div class="alert alert-danger mt-2 p-2">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="reportable_id" :value="comment.id"/>
                                                    <input type="hidden" name="reportable_type" value="Comment"/>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-warning">Report</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div v-if="comment.user_id == authUserId || authUserIsAdmin"
                                        class="modal fade" :id="'deleteCommentModal' + comment.id" tabindex="-1"
                                        :aria-labelledby="'deleteCommentModalLabel' + comment.id" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-dark">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" :id="'deleteCommentModalLabel' + comment.id">Delete Comment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure, you want to delete this Comment?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    <form method="POST" v-bind:action="comment.destroyRoute">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-warning" type="submit">Yes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
            isAdmin: "{{ Auth::id() != null && Auth::user()->is_admin }}",
            postId: "{{ $post->id }}",
            postRoute: "{{ route('api.posts.show', ['post'=>$post, 'offset' => 'offset_value']) }}",
            commentsStoreRoute: "{{ route('api.comments.store') }}"
        };
        </script>
    <script type="text/javascript" src="{{ URL::asset('js/show_and_create_comments.js') }}"></script>
    
</x-app-layout>