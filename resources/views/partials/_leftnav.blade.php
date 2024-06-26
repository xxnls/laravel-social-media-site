<div class="col-md-2 position-fixed mt-2">
    <div class="p-2">
        <ul class="nav flex-column">
            <div class="nav-item text-center">
                {{-- Profile picture --}}
                <x-show-profile-image :model="Auth::user()" :width="80" :height="80" />

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
                <a href="/myfeed" class="btn btn-light mt-1" data-toggle="tooltip" data-placement="right" title="Posts that you interacted with">
                    <i class="bi bi-file-post"></i>
                    My feed
                </a>
            </li>

            <li class="nav-item">
                <a href="/trending" class="btn btn-light mt-1" data-toggle="tooltip" data-placement="right" title="Posts ordered by likes amount">
                    <i class="bi bi-fire"></i>
                    Trending feed
                </a>
            </li>

            <li class="nav-item">
                <a href="/users/{{ Auth::user()->id }}/following" class="btn btn-light mt-1" data-toggle="tooltip" data-placement="right" title="Users that you follow">
                    <i class="bi bi-heart-fill"></i>
                    Following
                </a>
            </li>

            <li class="nav-item">
                <a href="/users/{{ Auth::user()->id }}/settings" class="btn btn-light mt-1">
                    <i class="bi bi-gear-fill"></i>
                    Settings
                </a>
            </li>
        </ul>
    </div>
</div>
