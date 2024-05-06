@extends("main")
@section("content")
    {{-- Delete account --}}
    <div class="card">
        <div class="card-header">
            Delete account
        </div>
        <div class="card-body">
            <form action="/users/{{$model->id}}" method="POST">
                @csrf
                @method('DELETE')
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    
                    @error('password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="confirmationCode">Confirmation code</label>
                    <input class="form-control" value="{{ $confirmationCode }}" disabled>
                </div>

                <div class="form-group">
                    <label for="confirmationCode">Enter confirmation code to proceed</label>
                    <input name="confirmationCode" id="confirmationCode" class="form-control" required>
                    
                    @error('confirmationCode')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-group">
                    <button type="submit" class="btn btn-danger mt-2">Delete account</button>
                    <a href="/users/{{$model->id}}/settings" class="btn btn-secondary mt-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection