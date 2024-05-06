@extends("main")
@section("content")
    <div class="card">
        <div class="card-header">
            Edit password
        </div>
        <div class="card-body">
            <form action="/users/{{$model->id}}/password" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">New password</label>
                    <input type="password" name="password" id="password" class="form-control" required>

                    @error('password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm password --}}
                <div class="form-group">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>

                    @error('password_confirmation')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-2">Change password</button>
                    <a href="/users/{{$model->id}}/settings" class="btn btn-secondary mt-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection