@extends("main")
@section("content")
<div class="card">
    {{-- Show post content --}}
    <div class="card">
        <div class="card-body">
            {{-- Show the user image, credentials, date of post, dropdown menu --}}
            <div class="row">
                <div class="col-auto">
                    <x-show-profile-image :model="$model->User"/>
                </div>

                <div class="col-auto">
                    <div class="short-div">{{ $model->User->first_name . ' ' . $model->User->last_name}}</div>
                    {{-- Date formatting --}}
                    <div class="short-div">{{ $model->created_at->format('jS \of F Y H:i'); }}</div>
                </div>

                {{-- Spacer --}}
                <div class="col"></div>

                {{-- Post dropdown menu (when user created post)--}}
                @if($model->user_id == Auth::id())
                    <x-post-dropdown-menu :model="$model" method="standard"/>
                @endif
            </div>

            {{-- Show the post content --}}
            <div class="row py-2">
                <div class="col">{{ $model->content }}</div>
            </div>

            {{-- Show the post image --}}
            @if($model->image_path)
                <div class="row text-center">
                    <div class="col">
                        <img src="{{ asset('img/posts/' . $model->image_path) }}" class="img-fluid" alt="post image">
                    </div>
                </div>
            @endif

                                    {{-- Like, comment buttons and counters --}}
                                    <div class="row mt-2 gx-2">
                                        {{-- Likes --}}
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-light rounded-circle">
                                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                            </button>
                                        </div>

                                        <div class="col-auto mt-2">
                                            0
                                        </div>

                                        <div class="col-auto mx-2"></div> {{-- Spacer --}}

                                        {{-- Comments --}}
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-light rounded-circle">
                                                <i class="bi bi-chat-fill"></i>
                                            </button>
                                        </div>

                                        <div class="col-auto mt-2">
                                            {{ count($model->comments) }}
                                        </div>
                                    </div>

                                    {{-- Show the post comments --}}
                                    @if(count($model->comments) > 0)
                                        <div class="row">
                                            <div>
                                                <hr>

                                                @foreach($model->comments as $comment)
                                                    <div class="row mt-3 mx-2">
                                                        <div class="col-md-1"></div> {{-- Spacer --}}

                                                        {{-- Profile image --}}
                                                        <div class="col-md-1">
                                                            <x-show-profile-image :model="$comment->User" />
                                                        </div>

                                                        {{-- User name and date --}}
                                                        <div class="col-md-3">
                                                            <div class="row">
                                                                <div class="short-div">{{ $comment->User->first_name . ' ' . $comment->User->last_name }}</div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="short-div">{{ $comment->created_at->format('jS \of F Y H:i'); }}</div>
                                                            </div>
                                                        </div>

                                                        {{-- Comment content --}}
                                                        <div class="col-auto card card-body" style="border-radius: 20px;">{{ $comment->content }} @if($comment->updated_at) <i class="opacity-75">(edited)</i> @endif</div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
        </div>
    </div>
</div>
@endsection
