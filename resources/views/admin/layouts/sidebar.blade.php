<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin-assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LARAVEL SHOP</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- <li class="nav-item">
                    <a href="{{ route('cities.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>City</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('areas.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Area</p>
                    </a>
                </li>                 --}}
                <li class="nav-item">
                    <a href="{{ route('account.property') }}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Properties</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('account.myJobApplications') }}" class="nav-link">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Interested</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('account.savedProperties') }}" class="nav-link">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Saved Property</p>
                    </a>
                </li>                
            </ul>
        </nav>
    </div>
 </aside>
