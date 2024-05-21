@extends("main")
@section("content")
    <div class="card">
        <div class="card-header">
            Edit city
        </div>
        <div class="card-body">
            <form method="POST" action="/users/{{$model->id}}/city" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="city">Old city</label>
                    <input type="text" class="form-control" value="{{ str_replace('_', ' ', $model->city) }}" disabled >
                </div>
                <div class="form-group">
                    <label for="new_city">New city</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                    @error('city')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                    <a href="/users/{{$model->id}}/settings" class="btn btn-secondary mt-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
