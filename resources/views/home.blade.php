<?php use Carbon\Carbon; ?>

@extends("main")
@section("content")

    @unless(count($models) == 0)

    <div>
        {{-- Show the posts --}}
        @foreach($models as $model)
            <div class="container mb-3">
                <div class="card">
                    <div class="card-body">
                        {{-- Show the user image, credentials, date of post --}}
                        <div class="row">
                            <div class="col-auto">
                                <img src="{{ asset('img/default/default-user.jpg') }}" class="rounded-circle img-thumbnail" style="width: 40px; height: 40px;" alt="default user image">
                            </div>
                            <div class="col">
                                <div class="short-div">{{ $model->User->first_name . ' ' . $model->User->last_name}}</div>
                                {{-- Date formatting --}}
                                <div class="short-div">{{ $model->created_at->format('jS \of F Y H:i'); }}</div>
                            </div>
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
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @else
        <p>No posts found</p>
    @endunless

@endsection