<div class="col-md-2 position-fixed mt-2">
    <div class="p-2">
        <ul class="nav flex-column">
            <div class="nav-item text-center">
                @if(Auth::user()->profile_image_path)
                    <img src="{{asset('img/users/' . Auth::user()->profile_image_path)}}" alt="Profile image" class="rounded-circle img-thumbnail" style="width: 80px; height: 80px;">
                @else
                    <img src="{{asset('img/default/default-user.jpg')}}" alt="Default profile image" class="rounded-circle img-thumbnail" style="width: 40px; height: 40px;">
                @endif

                <h4 class="px-2">{{Auth::user()->first_name . " " . Auth::user()->last_name}}</h4>
            </div>

            <li class="nav-item">
                <a {{--href="/users/{{Auth::user()->id}}/notifications"--}} class="btn btn-light mt-1">
                    <i class="bi bi-bell-fill"></i>
                    Notifications
                </a>
            </li>

            <li class="nav-item">
                <a href="/posts/create" class="btn btn-light mt-1">
                    <i class="bi bi-plus-circle"></i>
                    Add new post
                </a>
            </li>
            
            <li class="nav-item">
                <a href="/users/{{Auth::user()->id}}" class="btn btn-light mt-1">
                    <i class="bi bi-person-circle"></i>
                    My profile
                </a>
            </li>

            <li class="nav-item">
                <a {{--href=""--}} class="btn btn-light mt-1">
                    <i class="bi bi-file-post"></i>
                    My feed
                </a>
            </li>

            <li class="nav-item">
                <a href="/home" class="btn btn-light mt-1">
                    <i class="bi bi-fire"></i>
                    Trending feed
                </a>
            </li>

            <li class="nav-item">
                <a {{--href=""--}} class="btn btn-light mt-1">
                    <i class="bi bi-heart-fill"></i>
                    Friends and followers
                </a>
            </li>

            <li class="nav-item">
                <a href="/users/{{Auth::user()->id}}/settings" class="btn btn-light mt-1">
                    <i class="bi bi-gear-fill"></i>
                    Settings
                </a>
            </li>
        </ul>
    </div>
</div>