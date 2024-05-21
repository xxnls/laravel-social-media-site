@extends("main")
@section("content")
@unless(count($model) == 0)
    <div class="card card-body">
        <h3 class="mb-0">Following {{ count($model) }} people.</h3>

        @foreach ($model as $follow)
        <hr>
        <a href="/users/{{ $follow->id }}" class="link-dark">
            <div class="row">
                <div class="col-auto">
                    <x-show-profile-image :model="$follow" width="40" height="40"/>
                </div>
                <div class="col-auto pt-2">
                    <div>{{ $follow->first_name . ' ' . $follow->last_name }}</div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
@else
    <div class="card card-body">
        <h3>Following</h3>
        <hr class="mt-0">
        <div class="text-center">
            You are not following anyone.
        </div>
    </div>
@endunless
@endsection
