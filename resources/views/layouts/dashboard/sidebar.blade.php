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
        </ul>
    </div>
</div>
