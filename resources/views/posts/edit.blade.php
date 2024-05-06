@extends("main")
@section("content")
<div class="card">
    <div class="card-header">
        Edit post #{{$model->id}}
    </div>
    <div class="card-body">
        <form action="/posts/{{$model->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Content --}}
            <div class="form-group mb-2">
                <textarea id="content" name="content" class="form-control" aria-label="{{$model->content}}" value="{{$model->content}}">{{$model->content}}</textarea>
            
                @error('content')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image --}}
            @if($model->image_path) 
            <div class="row text-center">
                <div class="col">
                    <img src="{{ asset('img/posts/' . $model->image_path) }}" class="img-fluid" alt="post image">
                </div>
            </div>
            @endif

            <div class="d-flex mt-2">
                {{-- Create button --}}
                <div class="form-group">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>

                {{-- Add image input --}}
                <div class="form-group">
                    <div>
                        <input type="file" name="image_path" id="image_path" class="form-control" value="{{$model->image_path}}">

                        @error('image_path')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection