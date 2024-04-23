@extends("main")
@section("content")
<div class="card">
    <div class="card-header">
        Create new post
    </div>
    <div class="card-body">
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <textarea id="content" name="content" class="form-control" placeholder="What do you want to say?" aria-label="What do you want to say?" value="{{old('content')}}"></textarea>
            
                @error('content')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex mt-2">
                {{-- Create button --}}
                <div class="form-group">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>

                {{-- Add image input --}}
                <div class="form-group">
                    <div class="">
                        <input type="file" name="image_path" id="image_path" class="form-control" value="{{old('image_path')}}">

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