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
                <textarea id="content" name="content" class="form-control" placeholder="What do you want to say?" aria-label="What do you want to say?"></textarea>
            </div>

            <div class="form-group">
                <div class="row mt-2">
                    {{-- Create button --}}
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>

                    {{-- Add image input --}}
                    <div class="col-md-6">
                        <input type="file" name="image_path" id="image_path" class="form-control">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection