<header class="control-header">
    <div class="strip">
        <a class="navbar-brand" href="{{ route('front.home') }}"><img src="{{ asset('front-assets/images/logo.png') }}" /></a>
        <a class="toggleHeader toggleControl">
        </a>
    </div>
    
<a href="#" class="btn btn-secondary">Download App</a>

@if (Auth::check())
    <a href="#" class="btn btn-secondary">Dashboard</a>

    <div class="sidebar-modal-btn" data-bs-toggle="offcanvas" data-bs-target="#sideModal" aria-controls="sideModal">
        <svg width="12px" height="12px" viewBox="0 -1 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">								
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-210.000000, -887.000000)" fill="#666666">
                    <path d="M229,895 L211,895 C210.448,895 210,895.448 210,896 C210,896.553 210.448,897 211,897 L229,897 C229.552,897 230,896.553 230,896 C230,895.448 229.552,895 229,895 L229,895 Z M229,903 L211,903 C210.448,903 210,903.448 210,904 C210,904.553 210.448,905 211,905 L229,905 C229.552,905 230,904.553 230,904 C230,903.448 229.552,903 229,903 L229,903 Z M211,889 L229,889 C229.552,889 230,888.553 230,888 C230,887.448 229.552,887 229,887 L211,887 C210.448,887 210,887.448 210,888 C210,888.553 210.448,889 211,889 L211,889 Z" id="hamburger" sketch:type="MSShapeGroup">
                    </path>
                </g>
            </g>
        </svg>
        @if(Auth::user()->image)
            <img class="photo" src="{{ asset('uploads/profile/thumb/'.Auth::user()->image) }}" alt="" >
        @else
            <img class="photo" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/tenant-avatar.cedc2f44.png">
        @endif
    </div>
@else
    <div class="sidebar-modal-btn" data-bs-toggle="offcanvas" data-bs-target="#sideModal" aria-controls="sideModal">
        <svg width="12px" height="12px" viewBox="0 -1 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">								
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-210.000000, -887.000000)" fill="#666666">
                    <path d="M229,895 L211,895 C210.448,895 210,895.448 210,896 C210,896.553 210.448,897 211,897 L229,897 C229.552,897 230,896.553 230,896 C230,895.448 229.552,895 229,895 L229,895 Z M229,903 L211,903 C210.448,903 210,903.448 210,904 C210,904.553 210.448,905 211,905 L229,905 C229.552,905 230,904.553 230,904 C230,903.448 229.552,903 229,903 L229,903 Z M211,889 L229,889 C229.552,889 230,888.553 230,888 C230,887.448 229.552,887 229,887 L211,887 C210.448,887 210,887.448 210,888 C210,888.553 210.448,889 211,889 L211,889 Z" id="hamburger" sketch:type="MSShapeGroup">
                    </path>
                </g>
            </g>
        </svg>
        <img class="photo" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/tenant-avatar.cedc2f44.png">
    </div>					
@endif	

<nav>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
                <a href="{{ route('properties.index') }}" class="nav-link">
                    <i class="fa-regular fa-house side-icon"></i>
                    <span>Property</span>
                </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('account.myPropertyApplications') }}" class="nav-link {{ (\Request::route()->getName() == 'account.myPropertyApplications') ? 'active' : '' }}">
                <i class="fa-regular fa-house side-icon"></i>
                <span>Interested</span>
            </a>
        </li>
        <li class="nav-item">
                <a href="{{ route('property.savedProperties') }}" class="nav-link {{ (\Request::route()->getName() == 'property.savedProperties') ? 'active' : '' }}">
                <i class="fa-regular fa-floppy-disk side-icon"></i>
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
        @endif
    </ul>
</nav>
</header>