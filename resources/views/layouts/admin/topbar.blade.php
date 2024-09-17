<ul class="nk-quick-nav">
    <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
            <div class="user-toggle">
                <div class="user-avatar sm">
                    <em class="icon ni ni-user-alt"></em>
                </div>
                <div class="user-info d-none d-xl-block">
                    <div class="user-status user-status-verified">{{ Auth::user()->role }}</div>
                    <div class="user-name dropdown-indicator">{{ Auth::user()->name }}</div>
                </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                <div class="user-card">
                    <div class="user-info">
                        <span class="lead-text">{{ Auth::user()->name }}</span>
                        <span class="sub-text">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </div>
            <div class="dropdown-inner">
                <ul class="link-list">
                    <li><a href=""><em class="icon ni ni-setting-alt"></em><span>Настройка аккаунта</span></a></li>
                </ul>
            </div>
            <div class="dropdown-inner">
                <ul class="link-list">
                    <li>
                        <form method="post" action="{{ route('logout') }}" class="flex">
                            @csrf

                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><em class="icon ni ni-signout"></em><span>Выйти</span></a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </li>
</ul>
