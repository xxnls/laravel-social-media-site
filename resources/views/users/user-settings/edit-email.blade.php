@extends("main")
@section("content")
    <div class="card">
        <div class="card-header">
            Edit email
        </div>
        <div class="card-body">
            <form action="/users/{{$model->id}}/email" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Old Email --}}
                <div class="form-group">
                    <label for="email">Old email</label>
                    <input class="form-control" value="{{$model->email}}" disabled>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">New email</label>
                    <input type="email" name="email" id="email" class="form-control" required>

                    @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm email --}}
                <div class="form-group">
                    <label for="email_confirmation">Confirm email</label>
                    <input type="email" name="email_confirmation" id="email_confirmation" class="form-control" required>

                    @error('email_confirmation')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-2">Change email</button>
                    <a href="/users/{{$model->id}}/settings" class="btn btn-secondary mt-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection