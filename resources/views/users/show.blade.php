@extends("main")
@section("content")
<div class="card">
    <div class="card-body">
        <div class="row text-center mt-3">
            <div class="col">
                <x-show-profile-image :model="$model" width="100" height="100"/>
                <div class="h2">{{ $model->first_name . ' ' . $model->last_name }}</div>
            </div>
        </div>

        <hr>

        {{-- User details --}}
        <div class="row">
            <div class="col-md-4 text-center">
                <i class="bi bi-calendar-check-fill"></i>
                <div>{{ $model->created_at->format('d/m/Y') }}</div>
            </div>

            <div class="col-md-4 text-center">
                <i class="bi bi-heart-fill"></i>
                FOLLOWING COUNT TO DO
            </div>

            <div class="col-md-4 text-center">
                <i class="bi bi-calendar-check-fill"></i>
                OTHER COUNT TO DO
            </div>
        </div>
    </div>
</div>
@endsection
