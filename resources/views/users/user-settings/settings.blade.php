@extends("main")
@section("content")
    {{-- User settings menu --}}
    <div class="container col-md-6 mt-2">
        <div class="row">
            <div class="col"></div>

            <div class="col-auto">
                <h4>
                    <i class="bi bi-gear-fill"></i>
                    {{Auth::user()->first_name . " " . Auth::user()->last_name}}
                </h4>
            </div>

            <div class="col"></div>
        </div>

        <div class="row">
            <a class="btn btn-secondary mt-1" href="settings/credentials">
                <i class="bi bi-person-circle"></i>
                Change credentials
            </a>
        </div>

        <div class="row">
            <a class="btn btn-secondary mt-1" href="settings/email">
                <i class="bi bi-envelope-at-fill"></i>
                Change email
            </a>
        </div>

        <div class="row">
            <a class="btn btn-secondary mt-1" href="settings/password">
                <i class="bi bi-lock"></i>
                Change password
            </a>
        </div>

        <div class="row">
            <a class="btn btn-secondary mt-1" href="settings/profile-image">
                <i class="bi bi-person-badge"></i>
                Change profile picture
            </a>
        </div>

        <div class="row">
            <a class="btn btn-secondary mt-1" {{--href="/edit-user"--}}>
                <i class="bi bi-person-x-fill"></i>
                Delete account
            </a>
        </div>
    </div>
@endsection