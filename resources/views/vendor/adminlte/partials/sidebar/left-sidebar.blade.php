<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- Brand Logo --}}
    <a href="{{ route('home') }}" class="brand-link">
        <span class="brand-text font-weight-light">Control de Obras</span>
    </a>

    {{-- Sidebar --}}
    <div class="sidebar">

        {{-- Sidebar Menu --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('obras.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Obras</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('obras.papelera') }}" class="nav-link">
                        <i class="nav-icon fas fa-trash"></i>
                        <p>Papelera Obras</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('trabajadores.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Trabajadores</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('trabajadores.papelera') }}" class="nav-link">
                        <i class="nav-icon fas fa-trash"></i>
                        <p>Papelera Trabajadores</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/asignaciones') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>Asignaciones</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/fichajes') }}" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Fichajes</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/jornadas') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Jornadas</p>
                    </a>
                </li>

            </ul>
        </nav>
        {{-- /.sidebar-menu --}}
    </div>
    {{-- /.sidebar --}}
</aside>
