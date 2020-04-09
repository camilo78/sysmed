<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('root') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('/img/logo.png') }}" alt="Logo SYSMED" width="55">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }} </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>



    <hr class="sidebar-divider">

    @can('users.index')
    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Users') }}
    </div>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Users') }}</span>
        </a>
    </li>
    @endcan
    @can('users.index')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fas fa-fw fa-user-tag"></i>
            <span>{{ 'Roles' }}</span></a>
    </li>
    @endcan
    <!-- Nav Item - Charts -->
    @can('patients.index')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('patients.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('Patients') }}</span></a>
    </li>
    @endcan
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-user-nurse"></i>
            <span>{{ __('Assistants') }}</span></a>
    </li>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">

        {{ __('Services') }}
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('events.index') }}">
            <i class="fas fa-fw fa-calendar-plus"></i>
            <span>{{ __('Medical Appointments') }}</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
