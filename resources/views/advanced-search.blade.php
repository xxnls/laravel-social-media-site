@extends("main")
@section("content")
    <div class="card card-body">
        <h1>Advanced Search</h1>
        <hr class="mt-0">

        {{-- TO DO --}}
        <form action="/a-search" method="POST">
            <div class="input-group mb-3 w-50">
                <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
                <select class="form-select" name="search_type" id="search_type">
                    <option value="posts">Posts</option>
                    <option value="users">Users</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit">
                    Search
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
