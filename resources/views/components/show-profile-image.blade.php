{{-- Shows user profile image --}}

{{-- Default values --}}
@props(['model', 'width' => 50, 'height' => 50])

@if($model->profile_image_path && $model->is_active == 1)
    <img src="{{asset('img/users/' . $model->profile_image_path)}}" alt="Profile image" class="rounded-circle border" width="{{ $width }}" height="{{ $height }}">
@else
    <img src="{{asset('img/default/default-user.jpg')}}" alt="Default profile image" class="rounded-circle border" width="{{ $width }}" height="{{ $height }}">
@endif