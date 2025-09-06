<header class="control-header">
    <div id="pageLoader" class="page-loader">
        <img src="{{ asset('front-assets/images/loader.gif') }}" />    
    </div>

    <div class="strip">
        <a class="navbar-brand" href="{{ route('front.home') }}"><img src="{{ asset('front-assets/images/logo.png') }}" /></a>
        <a class="toggleHeader toggleControl">
            @if($categoryWord)
                {{ $categoryWord }} 
            @endif
            @if($citySelected)
                in {{ $citySelected->name }}
            @endif
            
            <i class="fa-solid fa-angle-down down-arrow"></i>
            <i class="fa-solid fa-angle-up up-arrow"></i>            
        </a>  

        @include('front.home.results.search') 
        @include('front.home.results.search_slide')
        @include('front.home.results.login')
                    
        <div class="overlay"></div>
    </div>
</header>