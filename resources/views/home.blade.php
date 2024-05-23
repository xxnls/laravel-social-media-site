<?php use Carbon\Carbon; ?>

@extends("main")
@section("content")

{{-- Script for AJAX usage --}}
<script>
    $(document).ready(function() {
        $(".deletePost").on("click", deletePost);
        $(".showUpdateForm").on("click", showUpdateForm);
        $(".showCommentForm").on("click", showCommentForm);
        $(".likePost").on("click", likePost);
    });
</script>

{{-- User Search --}}
@if($pageTitle == 'Users')
    @unless(count($models) == 0)
    <div class="card card-body">
        @foreach ($models as $user)
            <a href="/users/{{ $user->id }}" class="link-dark">
                <div class="row">
                    <div class="col-auto">
                        <x-show-profile-image :model="$user" width="40" height="40"/>
                    </div>
                    <div class="col-auto pt-2">
                        <div>{{ $user->first_name . ' ' . $user->last_name }}</div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    @else
        <div class="card card-body">
            <div class="text-center">
                No users found.
            </div>
        </div>
    @endunless
@else
    @unless(count($models) == 0)
        <div>
            {{-- Show the posts --}}
            @foreach($models as $model)
                <div class="container mb-3">
                    <div class="card">
                        <div class="card-body">
                            {{-- Show the user image, credentials, date of post, dropdown menu --}}
                            <div class="row">
                                <div class="col-auto">
                                    <x-show-profile-image :model="$model->User" />
                                </div>

                                <div class="col-auto">
                                    <a href="users/{{$model->user_id}}" class="short-div link-dark">
                                        {{-- User name --}}
                                        <div class="short-div">{{ $model->User->first_name . ' ' . $model->User->last_name}}</div>
                                    </a>
                                    {{-- Show post --}}
                                    <a href="posts/{{$model->id}}" class="short-div link-dark">
                                        {{-- Date formatting --}}
                                        <div class="short-div">{{ $model->created_at->format('jS \of F Y H:i'); }}</div>
                                    </a>
                                </div>

                                {{-- Spacer --}}
                                <div class="col"></div>

                                {{-- Post dropdown menu (when user created post)--}}
                                @if($model->user_id == Auth::id())
                                    <x-post-dropdown-menu :model="$model" method="ajax" />
                                @endif
                            </div>

                            {{-- Show the post content --}}
                            <div class="row pt-2">
                                <div class="col">{{ $model->content }}</div>
                            </div>

                            {{-- Show the post image --}}
                            @if($model->image_path)
                                <div class="row text-center pt-2">
                                    <div class="col">
                                        <img src="{{ asset('img/posts/' . $model->image_path) }}" class="img-fluid" alt="post image">
                                    </div>
                                </div>
                            @endif

                            {{-- Like, comment buttons and counters --}}
                            <div class="row mt-2 gx-2">
                                {{-- Likes --}}
                                <div class="col-auto">
                                    @if ($model->isLiked)
                                        <button type="button" class="btn btn-success rounded-circle likePost" data-id="{{ $model->id }}">
                                            <i class="bi bi-hand-thumbs-up-fill"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-light rounded-circle likePost" data-id="{{ $model->id }}">
                                            <i class="bi bi-hand-thumbs-up-fill"></i>
                                        </button>
                                    @endif
                                </div>

                                <div class="col-auto mt-2 likeCount" data-id="{{ $model->id }}">
                                    {{ $model->likes->count() }}
                                </div>

                                <div class="col-auto mx-2"></div> {{-- Spacer --}}

                                {{-- Comments --}}
                                <div class="col-auto">
                                    <button type="button" class="btn btn-light rounded-circle showCommentForm" data-auth="{{ json_encode(Auth::user()) }}" data-id="{{ $model->id }}">
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
                                                <div class="col-md-1 mx-3">
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
            @endforeach
        </div>
    @else
        <div class="card card-body">
            <div class="text-center">
                No posts found.
            </div>
        </div>
    @endunless
@endif

{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {{ $models->links() }}
</div>

@endsection
