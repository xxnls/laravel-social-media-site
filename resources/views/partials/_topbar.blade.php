<div class="navbar bg-body-secondary fixed-top">
    <a class="navbar-brand px-3" href="/home">Social Media Site</a>

    @auth
    {{-- Search bar --}}
    <form action="/search" method="GET" class="d-flex">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
        </div>          
    </form>

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