<li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="user-nav d-sm-flex d-none">
            <span class="user-name fw-bolder">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
            <span class="user-status">{{\Illuminate\Support\Facades\Auth::user()->role}}</span></div>
        <span class="avatar">
            <img class="round" src="{{\Illuminate\Support\Facades\Auth::user()->profile}}" alt="avatar" height="40" width="40">
            <span class="avatar-status-online"></span></span>
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
        <a class="dropdown-item" href="/user/setting"><i class="me-50" data-feather="user"></i> Profile</a>
        <div class="dropdown-divider"></div>
        <form method="post" action="/logout">@csrf
            <button class="dropdown-item full-width"><i class="me-50" data-feather="power"></i> Logout</button>
        </form>
    </div>
</li>
