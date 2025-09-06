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
            <span class="down-arrow">
                <?xml version="1.0" encoding="utf-8"?>
                <svg width="15px" height="15px" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M903.232 256l56.768 50.432L512 768 64 306.432 120.768 256 512 659.072z" fill="#ffffff" /></svg>
            </span>
            <span class="up-arrow">
                <?xml version="1.0" encoding="iso-8859-1"?>
                <svg fill="#ffffff" height="15px" width="15px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    viewBox="0 0 512.01 512.01" xml:space="preserve"><g>
                    <g><path d="M505.755,358.256L271.088,123.589c-8.341-8.341-21.824-8.341-30.165,0L6.256,358.256c-8.341,8.341-8.341,21.824,0,30.165
                            s21.824,8.341,30.165,0l219.584-219.584l219.584,219.584c4.16,4.16,9.621,6.251,15.083,6.251c5.462,0,10.923-2.091,15.083-6.251
                            C514.096,380.08,514.096,366.597,505.755,358.256z"/></g>
                    </g>
                </svg>
            </span>                
        </a>  

        @include('front.home.results.search') 
        {{-- @include('front.home.results.login') --}}
        @include('front.home.results.search_slide')
                    
        <div class="overlay"></div>
    </div>
</header>