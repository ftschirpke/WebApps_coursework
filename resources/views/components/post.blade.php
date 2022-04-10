<span class="border border-4 bg-dark border-dark rounded text-light">
    <div class="col-md-auto">
        <div class="container-fluid p-4">
            <h1>{{ $post->title ?? 'Post without title' }}</h1>
            <div class="row">
                <div class="col-5">
                    <h5>{{ $post->public ? "Public Post" : "Private Post" }} by 
                        <a class="text-warning" href="{{ route('accounts.show', ['account' => $post->user->account]) }}">
                            {{ $post->user->account->display_name }}
                        </a>
                    </h5>
                </div>
                <div class="col text-end">
                    created
                    @if (now()->subWeeks(1)->greaterThan($post->created_at))
                        at {{ $post->created_at }}
                    @else
                        {{ now()->longAbsoluteDiffForHumans($post->created_at) }}
                        ago
                    @endif
                    @if ( $post->updated_at != $post->created_at )
                        and updated
                        @if (now()->subWeeks(1)->greaterThan($post->updated_at))
                            at {{ $post->updated_at }}
                        @else
                            updated
                            {{ now()->longAbsoluteDiffForHumans($post->updated_at) }}
                            ago
                        @endif
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col text-top-start">
                    viewed by {{ $post->users_viewed_by->count() }} users
                </div>
            </div>
                
            <div class="clearfix">
                @if (!is_null($post->image_name))
                    @if (str_starts_with($post->image_name, 'http'))
                    <img src="{{ asset($post->image_name) }}" class="img-fluid pt-1 pe-3 pb-3 float-sm-start"/>
                    @else
                    <img src="{{ asset('storage/post_images/' . $post->image_name) }}" class="img-fluid pt-1 pe-3 pb-3 float-sm-start"/>
                    @endif
                @endif
                <p class="pull-left">{!! nl2br(e($post->message)) !!}</p>
                <!-- this converts line breaks to br-tags, such that
                    the text is still nicely formatted -->
            </div>
            <div class="row mb-2 mt-1">
                <div class="col">
                    @if (!$report)
                    @auth
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#reportModal">
                        Report
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reportModalLabel">Report Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
                                </div>
                                <form method="POST"
                                    action="{{ route('reports.store') }}">
                                    @csrf
                                <div class="modal-body">
                                    <div class="form-group p-2">
                                        @foreach (App\Models\Report::$categories as $category)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="category" type="radio" id="yes" value="{{ $category }}" {{ old('category') == $category ? 'checked' : '' }} required/>
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
                                        <textarea class="form-control textarea-autosize" id="report_message" rows="5" name="report_message"
                                        placeholder="Add a short description" aria-describedby="report_message_help" required autofocus
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
                                    <input type="hidden" name="reportable_id" value="{{ $post->id }}"/>
                                    <input type="hidden" name="reportable_type" value="Post"/>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-warning">Report</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                    @endif
                </div>
                
                @can('delete', $post)
                <div class="col text-end">
                    <x-delete-button type="Post">
                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning" type="submit">Yes</button>
                        </form>
                    </x-delete-button>
                </div>
                @endcan
            </div>
        </div>
    </div>
</span>