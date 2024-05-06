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
                    <div class="dropdown dropend col-auto">
                        <button type="button" class="btn btn-light rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="dropdown-menu">
                            <!-- Dropdown menu links -->
                            <a class="dropdown-item" href="{{$model->id}}/edit">Edit</a>
                            <form method="POST" href="{{$model->id}}">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item">Delete</button>
                            </form>
                        </div>
                    </div>
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
        </div>
    </div>
</div>
@endsection