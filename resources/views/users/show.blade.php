@extends("main")
@section("content")

<script>
    $(document).ready(function() {
        $(".followUser").on("click", followUser);
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>

<div class="card">
    <div class="card-body">
        <div class="row text-center mt-3">
            <div class="col">
                <x-show-profile-image :model="$model" width="100" height="100"/>
                <div class="h2">{{ $model->first_name . ' ' . $model->last_name }}</div>
            </div>
        </div>

        @if(Auth::check() && Auth::user()->id != $model->id)
            @if($model->isFollowing)
                <div class="row text-center mt-2">
                    <div class="col">
                        <button class="btn btn-success followUser" data-id="{{ $model->id }}">Unfollow</button>
                    </div>
                </div>
            @else
                <div class="row text-center mt-2">
                    <div class="col">
                        <button class="btn btn-light followUser" data-id="{{ $model->id }}">Follow</button>
                    </div>
                </div>
            @endif
        @endif

        <hr class="mt-3">

        {{-- User details --}}
        <div class="row">
            <div class="col-md-4 text-center">
                <i class="bi bi-calendar-check-fill" data-toggle="tooltip" data-placement="top" title="User since"></i>
                <div>{{ $model->created_at->format('d/m/Y') }}</div>
            </div>

            <div class="col-md-4 text-center" data-toggle="tooltip" data-placement="top" title="Followers">
                <i class="bi bi-heart-fill"></i>
                <div class="followersCount">{{ $model->followersCount }}</div>
            </div>

            <div class="col-md-4 text-center" data-toggle="tooltip" data-placement="top" title="Total likes">
                <i class="bi bi-hand-thumbs-up-fill"></i>
                <div>{{ $model->likesCount }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
