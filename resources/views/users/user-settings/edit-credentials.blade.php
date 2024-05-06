@extends("main")
@section("content")
<div class="card">
    <div class="card-header">
        Edit credentials
    </div>
    <div class="card-body">
        <form action="/users/{{$model->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- First name --}}
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{$model->first_name}}" required>

                @error('first_name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Last name --}}
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{$model->last_name}}" required>

                @error('last_name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Gender --}}
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control" required>
                    {{-- @if({{$model->gender}} == 'male') selected @endif --}}
                    <option value="male" {{ $model->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $model->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $model->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>

                @error('gender')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Date of birth --}}
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{$model->date_of_birth}}" required>

                @error('date_of_birth')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-2">Change credentials</button>
            </div>
        </form>
    </div>
</div>

@endsection