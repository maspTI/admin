<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('/img/masp.jpg') }}">
    <div class="logo">
        <a href="{{ route('dashboard.index') }}" class="simple-text logo-normal">Admin <span class="masp-logo">MASP</span></a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ url()->current() == route('dashboard.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('users.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i>
                    <p>Usuários</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('users.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.create') }}">
                    <i class="fas fa-user"></i>
                    <p>Criar Usuário</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('departments.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('departments.index') }}">
                    <i class="fas fa-city"></i>
                    <p>Departamentos</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('departments.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('departments.create') }}">
                    <i class="fas fa-city"></i>
                    <p>Criar Departamento</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('subdepartments.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('subdepartments.index') }}">
                    <i class="far fa-building"></i>
                    <p>Subdepartamentos</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('subdepartments.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('subdepartments.create') }}">
                    <i class="far fa-building"></i>
                    <p>Criar Subdepartamento</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('roles.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="fas fa-id-card-alt"></i>
                    <p>Funcoes</p>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('roles.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('roles.create') }}">
                    <i class="fas fa-id-card-alt"></i>
                    <p>Criar Funcao</p>
                </a>
            </li>
        </ul>
    </div>
</div>
