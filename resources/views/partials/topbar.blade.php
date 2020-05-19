<div class="loader-page"></div>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control-sm bg-light border-0 small" placeholder="Buscar por..."
                   aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary btn-sm" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                 aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar por..."
                               aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary" href="{{ route('consultations.create') }}"><i class="fas fa-fw fa-stethoscope"></i>
                <span class="d-none d-lg-block d-xl-block">Consulta</span>
                <span class="badge badge-success badge-counter"><i class="fas fa-plus"></i></span>
            </a>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-md fa-fw text-primary "></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">{{$count}}</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Consultas Pendientes
                </h6>
                <div class="overflow-auto" style="max-height: 420px">
                    @forelse($events as $event)
                        <a class="dropdown-item d-flex align-items-center" href="/patients/{{$event->patient_id}}">
                            <div class="mr-3">
                                <div class="icon-circle" style="background-color: {{$event->color}}">
                                    <i class="fas fa-calendar text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div
                                    class="small text-gray-500">{{Carbon\Carbon::parse($event->start)->formatLocalized('%d %B %Y %H:%M')}}</div>
                                <p class="font-weight-bold">{{$event->title}}</p>
                                <p class="text-muted"
                                   style=" margin-top: -15px;margin-bottom: -2px">{{$event->description}}</p>
                            </div>
                        </a>
                    @empty
                        <br>
                        <p class="text-center "> No hay consultas pendientes</p>
                    @endforelse
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('consultations.create') }}">Nueva Consulta</a>
            </div>

        </li>

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw text-warning"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">{{$count}}</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header bg-warning" style="border: 1px solid #f6c23e">
                    Citas Pendientes
                </h6>
                <div class="overflow-auto" style="max-height: 420px">
                    @forelse($events as $event)
                        <a class="dropdown-item d-flex align-items-center" href="/patients/{{$event->patient_id}}">
                            <div class="mr-3">
                                <div class="icon-circle" style="background-color: {{$event->color}}">
                                    <i class="fas fa-calendar text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div
                                    class="small text-gray-500">{{Carbon\Carbon::parse($event->start)->formatLocalized('%d %B %Y %H:%M')}}</div>
                                <p class="font-weight-bold">{{$event->title}}</p>
                                <p class="text-muted"
                                   style=" margin-top: -15px;margin-bottom: -2px">{{$event->description}}</p>
                            </div>
                        </a>
                    @empty
                        <br>
                        <p class="text-center "> No hay citas pendientes</p>
                    @endforelse
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('events.index') }}">Ir a calendario</a>

            </div>


        </li>
        <!-- Nav Item - Alerts -->


        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle"
                     src="{{ Gravatar::get(Auth::user()->email, ['size'=>200])}}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('users.show', auth()->user()->id) }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Profile') }}
                </a>
                <a class="dropdown-item" href="{{ Route('settings.index') }}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Configuraciones
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Registro de actividades
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal"
                   onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Salir') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>

</nav>
