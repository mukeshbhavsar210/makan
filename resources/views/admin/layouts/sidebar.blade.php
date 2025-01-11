<!-- Main Sidebar Container -->
<aside class="main-sidebar">
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
                @if( Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('cities.index') }}" class="nav-link {{ (\Request::route()->getName() == 'cities.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>City</p>
                        </a>
                    </li>  
                    <li class="nav-item">
                        <a href="{{ route('areas.index') }}" class="nav-link {{ (\Request::route()->getName() == 'areas.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Area</p>
                        </a>
                    </li>                                  
                    {{-- <li class="nav-item">
                        <a href="{{ route('categories.create') }}" class="nav-link">
                            <i class="nav-icon  fas fa-users"></i>
                            <p>Category</p>
                        </a>
                    </li>                     --}}
                    <li class="nav-item">
                        <a href="{{ route('amenities.index') }}" class="nav-link {{ (\Request::route()->getName() == 'amenities.index') ? 'active' : '' }}">
                            <i class="nav-icon  fas fa-users"></i>
                            <p>Amenities</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('builders.index') }}" class="nav-link {{ (\Request::route()->getName() == 'builders.index') ? 'active' : '' }}">
                            <i class="nav-icon  fas fa-users"></i>
                            <p>Builders</p>
                        </a>
                    </li>
                @endif

              
                <li class="nav-item">
                    <a href="{{ route('properties.index') }}" class="nav-link {{ (\Request::route()->getName() == 'properties.index') ? 'active' : '' }}">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Property</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('account.myPropertyApplications') }}" class="nav-link {{ (\Request::route()->getName() == 'account.myPropertyApplications') ? 'active' : '' }}">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Interested</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('property.savedProperties') }}" class="nav-link {{ (\Request::route()->getName() == 'property.savedProperties') ? 'active' : '' }}">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Saved Property</p>
                    </a>
                </li> 
            </ul>
        </nav>
    </div>
 </aside>
