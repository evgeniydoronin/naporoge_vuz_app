<ul class="nk-menu">
    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Dashboard</h6>
    </li><!-- .nk-menu-item -->
    <li class="nk-menu-item">
        <a href="{{ route('dashboard') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-growth-fill"></em></span>
            <span class="nk-menu-text">Аналитика</span>
        </a>
    </li><!-- .nk-menu-item -->

    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Applications</h6>
    </li><!-- .nk-menu-heading -->

    <li class="nk-menu-item has-sub">
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon"><em class="icon ni ni-home-alt"></em></span>
            <span class="nk-menu-text">ВУЗ</span>
        </a>
        <ul class="nk-menu-sub">
            <li class="nk-menu-item {{ request()->routeIs('universities.index') ? 'active':'' }}">
                <a href="{{ route('universities.index') }}" class="nk-menu-link"><span class="nk-menu-text">Все вузы</span></a>
            </li>
            <li class="nk-menu-item {{ request()->routeIs('universities.create') ? 'active':'' }}">
                <a href="{{ route('universities.create') }}" class="nk-menu-link"><span class="nk-menu-text">Добавить вуз</span></a>
            </li>
        </ul><!-- .nk-menu-sub -->
    </li><!-- .nk-menu-item -->

    <li class="nk-menu-item has-sub">
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon"><em class="icon ni ni-view-x1"></em></span>
            <span class="nk-menu-text">Группы</span>
        </a>
        <ul class="nk-menu-sub">
            <li class="nk-menu-item {{ request()->routeIs('groups.index') ? 'active':'' }}">
                <a href="{{ route('groups.index') }}" class="nk-menu-link"><span class="nk-menu-text">Все</span></a>
            </li>
            <li class="nk-menu-item {{ request()->routeIs('groups.create') ? 'active':'' }}">
                <a href="{{ route('groups.create') }}" class="nk-menu-link"><span class="nk-menu-text">Добавить</span></a>
            </li>
        </ul><!-- .nk-menu-sub -->
    </li><!-- .nk-menu-item -->

    <li class="nk-menu-item has-sub">
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon"><em class="icon ni ni-lock-alt"></em></span>
            <span class="nk-menu-text">Коды</span>
        </a>
        <ul class="nk-menu-sub">
            <li class="nk-menu-item {{ request()->routeIs('codes.index') ? 'active':'' }}">
                <a href="{{ route('codes.index') }}" class="nk-menu-link"><span class="nk-menu-text">Все</span></a>
            </li>
            <li class="nk-menu-item {{ request()->routeIs('codes.create') ? 'active':'' }}">
                <a href="{{ route('codes.create') }}" class="nk-menu-link"><span class="nk-menu-text">Добавить</span></a>
            </li>
        </ul><!-- .nk-menu-sub -->
    </li><!-- .nk-menu-item -->

    <li class="nk-menu-item {{ request()->routeIs('students.index') ? 'active':'' }}">
        <a href="{{ route('students.index') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
            <span class="nk-menu-text">Студенты</span>
        </a>
    </li><!-- .nk-menu-item -->


    <li class="nk-menu-item {{ request()->routeIs('managers.index') ? 'active':'' }}">
        <a href="{{ route('managers.index') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
            <span class="nk-menu-text">Менеджеры</span>
        </a>
    </li><!-- .nk-menu-item -->

    <li class="nk-menu-item has-sub">
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon"><em class="icon ni ni-edit"></em></span>
            <span class="nk-menu-text">Тексты</span>
        </a>
        <ul class="nk-menu-sub">
            <li class="nk-menu-item">
                <a href="contents.php" class="nk-menu-link"><span class="nk-menu-text">Теория к курсу и формы документов</span></a>
            </li>
        </ul><!-- .nk-menu-sub -->
    </li><!-- .nk-menu-item -->

</ul>
