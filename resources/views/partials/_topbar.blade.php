<div class="navbar bg-body-secondary fixed-top">
    <a class="navbar-brand px-3" href="/home">
        <i class="bi bi-person-circle mx-1"></i>
        Social Media Site
    </a>

    @auth
    {{-- Search bar with dropdown selection for Users/Post content --}}
    <form action="/" class="d-flex w-25">
        <div class="input-group">
            <input type="text" name="search" class="form-control w-25" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
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

    <a href="/a-search" class="btn btn-outline-secondary">
        Advanced Search
    </a>

    {{-- Weather API --}}
    <div class="d-flex">
        <x-weather-api />
    </div>

    {{-- Logout button --}}
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mx-2">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
    @else
    <div class="d-flex">
        <a href="/login" class="btn btn-primary mx-2">
            <i class="bi bi-box-arrow-in-right"></i> Login
        </a>
        <a href="/register" class="btn btn-primary mx-2">
            <i class="bi bi-person-plus"></i> Register
        </a>
    </div>
    @endauth
</div>
