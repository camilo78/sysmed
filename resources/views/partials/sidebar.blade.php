<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
    <li class="nav-item {{ Request::path() ==  'home' ? 'active' : ''  }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>


    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Atención
    </div>
@can('patients.index')
    <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Request::is( 'patients', 'patients/create' ) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users"></i>
                <span>Pacientes</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Acciones:</h6>
                    <a class="collapse-item" href="{{ route('patients.index') }}">{{ __('Tabla Pacientes') }}</a>
                    <a class="collapse-item" href="{{ route('patients.create') }}">Nuevo Paciente</a>
                </div>
            </div>
        </li>
@endcan

<!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
           aria-controls="collapseTwo">
            <i class="fas fa-fw fa-stethoscope"></i>
            <span>Consultas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Servicios:</h6>
                <a class="collapse-item" href="{{ route('consultations.index') }}">Consultas</a>
                <a class="collapse-item" href="{{ route('consultations.create') }}">Nueva Consulta</a>
                <a class="collapse-item" href="#">Control de Embarazos</a>
                <a class="collapse-item" href="#">Recetas</a>
                <a class="collapse-item" href="#">Exámenes de Diagnóstico</a>

            </div>
        </div>
    </li>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('events.index') }}">
            <i class="fas fa-fw fa-calendar-plus"></i>
            <span>{{ __('Medical Appointments') }}</span></a>
    </li>
    <hr class="sidebar-divider">
@can('users.index')
    <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Users') }}
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Request::is( 'users', 'users/create' ) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTre"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user"></i>
                <span>Usuarios</span>
            </a>
            <div id="collapseTre" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Acciones:</h6>
                    <a class="collapse-item" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                    <a class="collapse-item" href="{{ route('users.create') }}">Nuevo Usuario</a>
                </div>
            </div>
        </li>
    @endcan
    @can('assistants.index')
        <li class="nav-item {{ Request::is( 'assistants', 'assistants/create' ) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user-nurse"></i>
                <span>Asistentes</span>
            </a>
            <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Acciones:</h6>
                    <a class="collapse-item" href="{{ route('assistants.index') }}">Asistentes</a>
                    <a class="collapse-item" href="{{ route('assistants.create') }}">Nuevo Asistente</a>
                </div>
            </div>
        </li>
    @endcan
    @can('roles.index')
        <li class="nav-item {{ Request::is( 'roles', 'roles/create' ) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
               aria-expanded="true" aria-controls="collapseFive">
                <i class="fas fa-fw fa-user-tag"></i>
                <span>Roles</span>
            </a>
            <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Acciones:</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('roles.create') }}">Nuevo Rol</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
@endcan


<!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
