@extends("main")
@section("content")
    {{-- Change profile image --}}
    <div class="card">
        <div class="card-header">
            Edit profile image
        </div>
        <div class="card-body">
            <form action="/users/{{$model->id}}/profile-image" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                {{-- Old profile image --}}
                @if($model->profile_image_path)
                <div class="form-group">
                    <label for="profile_image">Old profile image</label>
                    <img src="{{asset('img/users/' . $model->profile_image_path)}}" alt="Profile image" class="rounded-circle img-thumbnail" style="width: 40px; height: 40px;">
                </div>
                @endif
                    
                {{-- Profile image --}}       
                <div class="form-group">
                    <label for="profile_image_path">New profile image</label>
                    <input type="file" name="profile_image_path" id="profile_image_path" class="form-control" required>
    
                    @error('profile_image_path')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>         
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-2">Change profile image</button>
                    <a href="/users/{{$model->id}}/settings" class="btn btn-secondary mt-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection