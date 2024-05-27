@extends("main")
@section("content")
    <div class="card card-body">
        <h1>Advanced Search</h1>
        <hr class="mt-1">

        <form action="/a-search" method="POST">
            @csrf
            <div class="container">
                {{-- Type --}}
                <div class="row mb-2">
                    <div class="col-md-4 mt-1 text-center">
                        <label for="search_type" class="form-label">Search Type</label>
                    </div>
                    <div class="col-md-8">
                        <select class="form-select" name="search_type" id="search_type">
                            <option value="posts">Posts</option>
                            <option value="users">Users</option>
                        </select>
                    </div>
                </div>
                {{-- Date --}}
                <div class="row mb-2">
                    <div class="col-md-4 mt-1 text-center">
                        <label for="creation_date" class="form-label">Creation Date</label>
                    </div>
                    <div class="col-md-4">
                        <input type="date" class="form-control" name="creation_date_from" id="creation_date_from">
                    </div>
                    <div class="col-md-4">
                        <input type="date" class="form-control" name="creation_date_to" id="creation_date_to">
                    </div>
                </div>
                <button class="btn btn-outline-secondary" type="submit">
                    Search
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
