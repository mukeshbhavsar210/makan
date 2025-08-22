<ul class="navbar-nav mb-auto w-100">
    <li class="nav-item">
        <a href="{{ route('properties.index') }}" class="nav-link">
            <i class="iconoir-view-grid menu-icon"></i>
            <span>Property</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('account.myPropertyApplications') }}" class="nav-link {{ (\Request::route()->getName() == 'account.myPropertyApplications') ? 'active' : '' }}">
            <i class="iconoir-trophy menu-icon"></i>
            <span>Interested</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('property.savedProperties') }}" class="nav-link {{ (\Request::route()->getName() == 'property.savedProperties') ? 'active' : '' }}">
            <i class="iconoir-peace-hand menu-icon"></i>
            <span>Saved Property</span>
        </a>
    </li> 
    @if( Auth::user()->role == 'admin')        
        <li class="nav-item">
            <a href="{{ route('builders.index') }}" class="nav-link">
                <i class="iconoir-compact-disc menu-icon"></i>
                <span>Builders</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cities.index') }}" class="nav-link ">
                <i class="iconoir-home-simple menu-icon"></i>
                <span>City</span>
            </a>
        </li>  
        <li class="nav-item">
            <a href="{{ route('areas.index') }}" class="nav-link">
                <i class="iconoir-view-grid menu-icon"></i>
                <span>Area</span>
            </a>
        </li>  
        <li class="nav-item">
            <a href="{{ route('amenities.index') }}" class="nav-link">
                <i class="iconoir-table-rows menu-icon"></i>
                <span>Amenities</span>
            </a>
        </li> 
    @endif
</ul>