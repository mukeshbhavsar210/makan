@extends('front.layouts.app')

@section('hideHeader') @endsection

<div id="pageLoader" class="page-loader">
    <img src="{{ asset('front-assets/images/loader.gif') }}" />    
</div>

<header class="control-header">
    <div class="strip">
        <a class="navbar-brand" href="{{ route('front.home') }}"><img src="{{ asset('front-assets/images/logo.png') }}" /></a>
        <a class="toggleHeader toggleControl">
            @if($categoryWord)
                {{ $categoryWord }} 
            @endif
            in {{ $citySelected->name }}
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

        <form action="{{ route('properties') }}" >                            
            <div class="search-strip">
                <ul id="areas_top" >
                    @if(Request::get('city'))
                        @php
                            $areas = \App\Models\Area::where('city_id', Request::get('city'))->get();
                            $selectedAreas = (array) Request::get('area'); // multiple areas allowed
                        @endphp

                        @php
                            // First area to display (either first selected or default first area)
                            $firstAreaId = $selectedAreas ? $selectedAreas[0] : ($areas[0]->id ?? null);
                        @endphp

                        {{-- Show only the first area --}}
                        @if($firstAreaId)
                            @php $firstArea = $areas->firstWhere('id', $firstAreaId); @endphp
                            @if($firstArea)
                                <li>
                                    <label class="custom-checkbox-label">
                                        <input type="checkbox" name="area[]" value="{{ $firstArea->id }}" checked>
                                        {{ $firstArea->name }}
                                        <a href="javascript:void(0);" class="remove-area" data-id="{{ $firstArea->id }}">
                                            <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"/></svg>
                                        </a>
                                    </label>
                                </li>
                            @endif
                        @endif

                        @php
                            // Ensure only unique area IDs are counted
                            $selectedUnique = collect($selectedAreas)->unique();
                            $allAdded = $selectedUnique->count() >= $areas->count();
                        @endphp

                        @if($areas->count() > 2)
                            @if(!$allAdded)
                                <li>
                                    <a href="javascript:void(0);" id="showAllAreas" class="show-all"> 
                                        Add 
                                        <svg fill="#0d6efd" width="16px" height="16px" viewBox="-3 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                            <path d="M12.711 9.182a1.03 1.03 0 0 1-1.03 1.03H7.53v4.152a1.03 1.03 0 0 1-2.058 0v-4.152H1.318a1.03 1.03 0 1 1 0-2.059h4.153V4.001a1.03 1.03 0 0 1 2.058 0v4.152h4.153a1.03 1.03 0 0 1 1.029 1.03z"/>
                                        </svg>
                                    </a>
                                </li>
                            @endif
                        @endif                 
                @endif
            </ul>

                {{-- Hidden Areas (only extra selected areas beyond the first) --}}               
                <div class="hidden-areas-added">
                    @php $rendered = []; @endphp

                    @php 
                        $rendered = [];
                        $selectedUnique = collect($selectedAreas)->unique();
                    @endphp

                    <ul class="added" style="{{ $selectedUnique->count() > 1 ? '' : 'display:none;' }}">
                        @foreach($selectedAreas as $index => $areaId)
                            @if($index > 0 && !in_array($areaId, $rendered))
                                @php 
                                    $area = $areas->firstWhere('id', $areaId); 
                                    $rendered[] = $areaId;
                                @endphp
                                @if($area)
                                    <li>
                                        <label class="custom-checkbox-label">
                                            <input type="checkbox" name="area[]" value="{{ $area->id }}" checked> 
                                            {{ $area->name }}
                                            <a href="javascript:void(0);" class="remove-area" data-id="{{ $area->id }}">
                                                <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"/>
                                                </svg>
                                            </a>
                                        </label>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>

                    <ul class="hidden-areas" style="display: none" >
                        @foreach($areas as $index => $area)
                            @if(!in_array($area->id, $selectedAreas) && !(!$selectedAreas && $index == 0))
                                <li>
                                    <label class="custom-checkbox-label">
                                        <input type="checkbox" name="area[]" value="{{ $area->id }}">
                                        {{ $area->name }}
                                        <svg fill="#0d6efd" width="16px" height="16px" viewBox="-3 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><path d="M12.711 9.182a1.03 1.03 0 0 1-1.03 1.03H7.53v4.152a1.03 1.03 0 0 1-2.058 0v-4.152H1.318a1.03 1.03 0 1 1 0-2.059h4.153V4.001a1.03 1.03 0 0 1 2.058 0v4.152h4.153a1.03 1.03 0 0 1 1.029 1.03z"></path></svg>
                                    </label>
                                </li>
                            @endif
                        @endforeach  
                    </ul>
                </div>                     
            </div>
        </form> 
        
        <a class="btn btn-primary" href="" type="submit">List Property Free</a>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideModal" aria-controls="sideModal">Login</button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="sideModal" aria-labelledby="sideModalLabel">
        <div>
            <div class="css-1d7igk2">
                <div class="css-1a1kv9n">
                    <div class="css-aknk">
                        <div class="css-1r8j6uz">
                            <div class="css-70qvj9">
                                <img class="img css-1qf48we" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/tenant-avatar.cedc2f44.png">
                                <div class="css-1qhmto6">
                                    <div class="css-urapr9">Hello  👋🏻</div>
                                    <div class="css-1c24lhr">Easy Contact with sellers</div>
                                    <div class="css-1c24lhr">Personalized experience</div>
                                </div>

                                @if (Auth::check())
                                    <a href="{{ route('profile.index')}}" class="btn btn-primary">My Account</a>
                                @else
                                    {{-- <a href="{{ route('account.login')}}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="nav-link text-dark">Login/Register</a> --}}
                                    <a href="{{ route('account.login')}}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Login</a>
                                @endif
                            </div>
                            </div>
                            <div class="css-13uh3bk"></div>
                            <div class="css-nf8lu8">
                                <div class="css-1wdo9tm">My Activity</div>
                                <div class="T_visibilityNudgeContainerStyle _l8idpf _e2cmky _l115vq _l01wug T_tilesContainerStyle _12gmglyw _ks15zi _cxftgi _9s1txw">
                                    <div id="contactedProperties" class="_vy7ynd _e2ca9o _0h1h6o _l8tzce _fc1y6m _cs1nn1 _c81fwx _1y0kqslr T_visibilityNudgePillStyle t1erharo _g9mt1kf2 _raf011w6 _5z111l08 _3f1e1l _9jtlke _mkh2mm _ar1bp4 _9s1txw _7l1d6m _r31h6o _5jftgi _1ti04wu4 _bof91jbn _lzn0158e _261jsd T_TitleWrapper" style="--1u6u2i1: '\e98f'; --1txmub6: #4e4e4e; --sac6kx: #ffffff; --1yrc1ga: 1px solid #d4d4d4; --1yo8p3h: 1px solid #5d46db; --o7otvt: #5E23DC;">
                                        <div data-visibility-nudge="true" data-profile-desktop-url="false" class="v1hscdnl _1yzv1y44 _p4221h6o _vy951h6o _18811txw _1fu01osq _mtkvexct _6w1e54 _9scj1k _fycs5v _ks15vq _g3dlk8 _c81fwx _h3j7go T_VisibilityNudgePillName" style="--ymicyk: 0px;">Contacted Properties</div><div class="v17f23e4 _git3bu _7l1ulh _g3dlk8 _5j19bv _e2exct _vy1vi7 _fc1h6o _0h1h6o _9s1txw _261oci T_VisibilityNudgeCountStyle" style="--1c7gtbt: rgba(153, 153, 153, 0.22);">00</div></div><div id="seenProperties" class="_2619j3 _70qisa T_activeTileStyle _1ti01994 _3f1r0o _mkh2mm T_coloredActiveTileStyle _vy7ynd _e2ca9o _0h1h6o _l8tzce _fc1y6m _cs1nn1 _c81fwx _1y0kqslr T_visibilityNudgePillStyle _19381yyf _1h8oqx4o _2zt8stnw _1hh41r5k _105419bv _89if1ssb _1sjyzr6s _3l8v1osq _1880mgnk _1ymp1do4 T_activePillNotchDesktopStyle t1erharo _g9mt1kf2 _raf011w6 _5z111l08 _9jtlke _ar1bp4 _9s1txw _7l1d6m _r31h6o _5jftgi _bof91jbn _lzn0158e T_TitleWrapper" style="--1u6u2i1: '\e97d'; --1txmub6: #4e4e4e; --sac6kx: #ffffff; --1yrc1ga: 1px solid #5d46db; --1yo8p3h: 1px solid #5d46db; --o7otvt: #5E23DC;"><div data-visibility-nudge="true" data-profile-desktop-url="false" class="v1hscdnl _1yzv1y44 _p4221h6o _vy951h6o _18811txw _1fu01osq _mtkvexct _6w1e54 _9scj1k _fycs5v _ks15vq _g3dlk8 _c81fwx _h3j7go T_VisibilityNudgePillName" style="--ymicyk: 0px;">Seen Properties</div><div class="v17f23e4 _git3bu _7l1ulh _g3dlk8 _5j19bv _e2exct _vy1vi7 _fc1h6o _0h1h6o _9s1txw _261oci T_VisibilityNudgeCountStyle" style="--1c7gtbt: rgba(94, 35, 220, 0.22);">00</div></div><div id="savedProperties" class="_vy7ynd _e2ca9o _0h1h6o _l8tzce _fc1y6m _cs1nn1 _c81fwx _1y0kqslr T_visibilityNudgePillStyle t1erharo _g9mt1kf2 _raf011w6 _5z111l08 _3f1e1l _9jtlke _mkh2mm _ar1bp4 _9s1txw _7l1d6m _r31h6o _5jftgi _1ti04wu4 _bof91jbn _lzn0158e _261jsd T_TitleWrapper" style="--1u6u2i1: '\e97e'; --1txmub6: #4e4e4e; --sac6kx: #ffffff; --1yrc1ga: 1px solid #d4d4d4; --1yo8p3h: 1px solid #5d46db; --o7otvt: #5E23DC;"><div data-visibility-nudge="true" data-profile-desktop-url="false" class="v1hscdnl _1yzv1y44 _p4221h6o _vy951h6o _18811txw _1fu01osq _mtkvexct _6w1e54 _9scj1k _fycs5v _ks15vq _g3dlk8 _c81fwx _h3j7go T_VisibilityNudgePillName" style="--ymicyk: 0px;">Saved Properties</div><div class="v17f23e4 _git3bu _7l1ulh _g3dlk8 _5j19bv _e2exct _vy1vi7 _fc1h6o _0h1h6o _9s1txw _261oci T_VisibilityNudgeCountStyle" style="--1c7gtbt: rgba(153, 153, 153, 0.22);">00</div></div><div id="recentSearches" class="_vy7ynd _e2ca9o _0h1h6o _l8tzce _fc1y6m _cs1nn1 _c81fwx _1y0kqslr T_visibilityNudgePillStyle t1erharo _g9mt1kf2 _raf011w6 _5z111l08 _3f1e1l _9jtlke _mkh2mm _ar1bp4 _9s1txw _7l1d6m _r31h6o _5jftgi _1ti04wu4 _bof91jbn _lzn0158e _261jsd T_TitleWrapper" style="--1u6u2i1: '\e97c'; --1txmub6: #4e4e4e; --sac6kx: #ffffff; --1yrc1ga: 1px solid #d4d4d4; --1yo8p3h: 1px solid #5d46db; --o7otvt: #5E23DC;"><div data-visibility-nudge="true" data-profile-desktop-url="false" class="v1hscdnl _1yzv1y44 _p4221h6o _vy951h6o _18811txw _1fu01osq _mtkvexct _6w1e54 _9scj1k _fycs5v _ks15vq _g3dlk8 _c81fwx _h3j7go T_VisibilityNudgePillName" style="--ymicyk: 0px;">Recent Searches</div><div class="v17f23e4 _git3bu _7l1ulh _g3dlk8 _5j19bv _e2exct _vy1vi7 _fc1h6o _0h1h6o _9s1txw _261oci T_VisibilityNudgeCountStyle" style="--1c7gtbt: rgba(153, 153, 153, 0.22);">01</div>
                                    </div>
                                </div>
                            </div>
                                        
                            <div class="cmn-wrapper">
                                <div class="css-1s390b6"><img class="img css-1ps6pnn" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/fallback.3b935c39.svg"><button data-testid="buttonId" class="_h31f4h _g314no _vy93m8 _r31h6o _2d1e1b _5jftgi _3fn7od _l8n7od _csbfng _c81fwx _7l1994 T_oldSearchBtnStyle T_btnStyle _j9qr11ef _1yfe11ef _xvuoe25i _1vt4glyw _1q73uea4 _9jtlke _26oii0 cta">Start new search</button>
                                </div>

                                <a class="T_containerStyle" href="/rent-sell-property?utm_medium=SRP&amp;utm_source=housing">
                                    <div>

                                    </div>
                                    <img fetchpriority="low" class="_0p1eb7 T_imageTransitionEffectFullOpacity _jp1dfr T_imageStyle _vyz0at _e2nagk T_imageStyle img" decoding="async" src="//c.housingcdn.com/demand/s/client/common/assets/postProperty.3f9c046b.svg">
                                    <div class="_9s1txw _cxftgi _ar1bp4 _fc1yb4 _e2ymf6 T_textContainerStyle">
                                        <div class="_vyntd2 _e21vi7 _c8dlk8 _cs1nn1 _g3exct _r31e5h _7l1ulh T_headingStyle">Looking to sell / rent your property?</div><div class="_261pec _70i5yl _5j14y2 _c81fwx _csbfng _g3exct _r31h6o _7ls3je _e21ul9 _vymhvn _9s1txw _fc1h6o _0h1h6o T_ctaStyle">Post property for FREE</div>
                                    </div>
                                </a>
                            </div>

                            <div class="css-1vom6bc">
                                <div class="css-7o2ihh">Zero Brokerage Properties</div>
                                <div class="css-pk8tdi">
                                    <div class="css-17pf2g"></div>
                                </div>
                            </div>

                            <div class="css-1vom6bc">
                                <div class="css-1lw7yxt">My Transactions</div>
                                <div class="css-pk8tdi">
                                    <div class="css-17pf2g"></div>
                                </div>
                            </div>

                            <div class="css-1vom6bc">
                                <div class="css-cbbif3">My Reviews<span class="css-kr4tkc">New</span></div>
                                <div class="css-pk8tdi">
                                    <div class="css-17pf2g"></div>
                                </div>
                            </div>

                            <div class="css-13uh3bk"></div>
                            
                            <div class="css-1vom6bc">
                                <div class="css-vaa0za">Quick Links</div>
                                <div class="css-pk8tdi">
                                    <a class="css-ck7fsc" href="/"><div class="css-ttlyn2">Home</div></a>
                                    <a class="css-er4el4" href="/rent-sell-property"><div class="css-ttlyn2">Post Properties</div></a>
                                    <a class="css-pgc563" href="/news"><div class="css-ttlyn2">News</div></a>
                                    <a class="css-1iox6fb" href="https://new.housing.com/research-reports"><div class="css-ttlyn2">Research</div></a>
                                    <a class="css-t7j3h0" href="/transaction/locality/72ac53e7566c9f8bff3b"><span class="css-1dvtchi">New</span><div class="css-ttlyn2">Registry Records</div></a>
                                    <a class="css-15muufz" href="/edge/pay-rent?utm_medium=dweb_hook&amp;utm_source=profile_page_quick_links"><div class="css-ttlyn2">Pay on Credit</div></a>
                                    <a class="css-2w2ijs" href="/edge/protection-plans?source=profile_page_quick_links"><span class="css-1dvtchi">New</span><div class="css-ttlyn2">Housing Protect</div></a>
                                </div>
                            </div>

                        <div class="css-1vom6bc"><div class="css-k01lej">Residential Packages</div>
                        <div class="css-pk8tdi">
                            <a class="css-1kc5kd3" href="/partners/developer?utm_source=home_page&amp;utm_medium=side_menu">
                                <div class="css-ttlyn2">For Developers</div>
                            </a>
                            <a class="css-3vb0yq" href="/partners/broker?utm_source=home_page&amp;utm_medium=side_menu">
                                <div class="css-ttlyn2">For Brokers</div>
                            </a>
                            <a class="css-nksu7s" href="https://seller.housing.com/owner-packages?profile=owner&amp;utm_medium=SRP&amp;utm_source=housing">
                                <div class="css-ttlyn2">For Owners</div>
                            </a>
                            <a class="css-dsrw81" href="/premium?source=profile_page_quick_links">
                                <div class="css-ttlyn2">Housing Premium</div>
                            </a>
                        </div>
                    </div>
                    <div class="css-1vom6bc">
                        <div class="css-1jkwbr8">Housing Edge</div>
                        <div class="css-pk8tdi">
                            <a class="css-1t9tylx" href="https://housing.com/edge/pay-rent">
                                <div class="css-ttlyn2">Pay on Credit</div>
                            </a>
                            <a class="css-dsrw81" href="/premium-exclusive?source=profile_page_housing_edge">
                                <div class="css-ttlyn2">Housing Premium</div>
                            </a>
                            <a class="css-topaay" href="https://housing.com/home-loans">
                                <div class="css-ttlyn2">Home Loans</div>
                            </a>
                            <a class="css-2w2ijs" href="https://housing.com/edge/protection-plans?source=profile_page_housing_edge">
                                <span class="css-1dvtchi">New</span>
                                <div class="css-ttlyn2">Housing Protect</div>
                            </a>
                            <a class="css-1q2mcd3" href="/edge/rent-receipt-generator">
                                <div class="css-ttlyn2">Rent Receipt Generator</div>
                            </a>
                        </div>
                    </div>
                    <div class="css-1vom6bc">
                        <div class="css-f1x2u0">Services</div>
                        <div class="css-pk8tdi">
                            <a class="css-1gwpeio" href="/buy-real-estate-ahmedabad">
                                <div class="css-ttlyn2">Buy Properties</div>
                            </a>
                            <a class="css-er4el4" href="/rent/property-for-rent-in-ahmedabad">
                                <div class="css-ttlyn2">Rent Properties</div></a>
                            <a class="css-ouxaop" href="/paying-guests/pgs-in-ahmedabad">
                                <div class="css-ttlyn2">PG/Co-Living</div>
                            </a>
                            <a class="css-v07chn" href="/home-loans">
                                <div class="css-ttlyn2">Apply for Home Loan</div>
                            </a>
                            <a class="css-ajvez3" href="/home-loans-emi-calculator">
                                <div class="css-ttlyn2">EMI Calculator</div>
                            </a>
                            <a class="css-1gwpeio" href="/edge/free-rent-value-calculator">
                                <div class="css-ttlyn2">Property Value</div>
                            </a>
                        </div>
                    </div>
                    <div class="css-1vom6bc">
                        <div class="css-mhayl">Unsubscribe Alerts</div>
                        <div class="css-pk8tdi">
                            <div class="css-17pf2g"></div>
                        </div>
                    </div>
                    <div class="css-1vom6bc">
                        <div class="css-ltwsm3">Housing Advice</div>
                        <div class="css-pk8tdi">
                            <a class="css-1cf3l1h" href="/buying-guide">
                                <div class="css-ttlyn2">Buying Guide</div>
                            </a>
                        </div>
                    </div>
                    <div class="css-1vom6bc">
                        <div class="css-ty8ubi">Report a Fraud</div>
                        <div class="css-pk8tdi">
                            <div class="css-17pf2g"></div>
                        </div>
                    </div>
                    <div class="css-x4croi">
                        <div class="css-1502bnp"> Visit Help Center</div>
                            <div class="css-yibggk"><div class="css-13ewv5y"><div class="css-1b3xa19">Download Housing App</div><div class="css-1qwz5j2"><span class="css-0"><img class="css-p6vbf2" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/app-store.10009972.png"></span><span class="css-0"><img class="css-p6vbf2" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/google-play.2c209e8c.png"></span>
                            </div>
                        </div>
                        <img class="img css-fkxcmo" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/qr-code.f143ed3a.png">
                        </div>
                    </div>
                    <div class="css-1oj4dvm">
                        <div>Follow on</div>
                        <div class="css-13t3iqc">
                            <a class="css-160t0en" href="http://www.facebook.com/housing.co.in"></a>
                            <a class="css-1pf53ps" href="https://instagram.com/housingindia/"></a>
                            <a class="css-1t11qa7" href="https://www.linkedin.com/company/housing-com/"></a>
                            <a class="css-a3gf5b" href="https://twitter.com/housing"></a>
                            <a class="css-1165oc6" href="https://www.youtube.com/user/HousingY"></a>
                        </div>
                    </div>
                </div>
                        <div id="renderItemRoot"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-header">
        <div class="search-engine">
            <form action="{{ route('properties') }}" >            
                <ul class="rentBuy">
                    <li>I'm looking to</li>
                    @if ($categories)                               
                        @foreach ($categories as $value)                            
                            <li>
                                <label class="{{ request('category') == $value->id || (!request('category') && $loop->first) ? 'activeTab' : '' }}">
                                    <input type="radio" name="category" value="{{ $value->id }}"
                                        {{ request('category') == $value->id || (!request('category') && $loop->first) ? 'checked' : '' }}>
                                    {{ $value->name }}
                                </label>
                            </li>
                        @endforeach                            
                    @endif
                </ul>

                <div class="search-controls">
                    <div class="flex-search">
                        <div class="left">
                            <select name="city" id="city" class="city">
                                <option value="">Select City</option>
                                @foreach ($cities as $c)
                                    <option value="{{ $c->id }}" {{ Request::get('city') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>    
                        </div>
                        <div class="right">
                            <div class="areas-list">
                                <ul id="areas" >
                                    @if(Request::get('city'))
                                        @php
                                            $areas = \App\Models\Area::where('city_id', Request::get('city'))->get();
                                            $selectedAreas = (array) Request::get('area'); // multiple areas allowed
                                        @endphp

                                        {{-- Show selected areas with remove (X) --}}
                                        @foreach($areas as $index => $area)
                                            @if(in_array($area->id, $selectedAreas) || (!$selectedAreas && $index == 0))
                                                <li class="active">
                                                    <label class="custom-checkbox-label">
                                                        <input type="checkbox" name="area[]" value="{{ $area->id }}" checked>
                                                        {{ $area->name }}
                                                        <a href="javascript:void(0);" class="remove-area" data-id="{{ $area->id }}">
                                                            <svg fill="#ffffff" width="16px" height="16px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"/></svg>
                                                        </a>
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Add More Button --}}
                                        @if($areas->count() > 1)
                                            <li>
                                                <a href="javascript:void(0);" id="showAllAreas" class="show-all">
                                                    Add 
                                                    <svg fill="#0d6efd" width="16px" height="16px" viewBox="-3 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><path d="M12.711 9.182a1.03 1.03 0 0 1-1.03 1.03H7.53v4.152a1.03 1.03 0 0 1-2.058 0v-4.152H1.318a1.03 1.03 0 1 1 0-2.059h4.153V4.001a1.03 1.03 0 0 1 2.058 0v4.152h4.153a1.03 1.03 0 0 1 1.029 1.03z"/></svg>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                                {{-- Hidden Areas --}}                                
                                <ul class="hidden-areas" style="display:none;">
                                    @foreach($areas as $index => $area)
                                        @if(!in_array($area->id, $selectedAreas) && !(!$selectedAreas && $index == 0))
                                            <li>
                                                <label class="custom-checkbox-label">
                                                    <input type="checkbox" name="area[]" value="{{ $area->id }}">
                                                    {{ $area->name }}
                                                </label>
                                            </li>
                                        @endif
                                    @endforeach  
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="right-btn">
                        <button class="btn btn-primary" type="submit">Search</button>      
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="overlay"></div>
</header>

@section('main')

<div class="listing-page">
    <form action="{{ route('properties') }}" > 
        <div class="container-fluid">
            <div class="filters">
                <div class="dropdown {{ request('category') == 27 ? 'hidden-property-type' : '' }}">
                    <button class="btn control-btn btnFilter dropdown-toggle" type="button" id="typeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Property Type
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="typeDropdown" >
                        @foreach ($propertyTypes as $value)
                            <li>
                                <label class="dropdown-item custom-checkbox-label {{ is_array(request('type')) && in_array($value->id, request('type')) ? 'active' : '' }}">
                                    <input type="checkbox" name="type[]" value="{{ $value->id }}" data-label="{{ $value->name }}"
                                        {{ is_array(request('type')) && in_array($value->id, request('type')) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    {{ $value->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn control-btn btnFilter dropdown-toggle" type="button" id="roomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        BHK Type
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="roomDropdown" >
                        @foreach ($rooms as $value)
                            <li>
                                <label class="dropdown-item custom-checkbox-label {{ is_array(request('room')) && in_array($value->id, request('room')) ? 'active' : '' }}">
                                    <input type="checkbox" name="room[]" value="{{ $value->id }}"
                                        data-label="{{ $value->title }}"
                                        {{ is_array(request('room')) && in_array($value->id, request('room')) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    {{ $value->title }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col">
                    <div class="dropdown">
                        <button class="btn btnFilter btn-secondary dropdown-toggle" type="button" id="priceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Price Range
                        </button>
                        <ul class="dropdown-menu custom-price" aria-labelledby="priceDropdown">
                            <form id="filterForm" method="GET" action="{{ route('properties.index') }}">
                                <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min') }}">
                                <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max') }}">
                                <input type="text" id="priceRange" />
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button type="button" id="resetPriceRange" class="btn btn-secondary">Reset</button>
                            </form>
                        </ul>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btnFilter dropdown-toggle" type="button" id="saletypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Sale Type
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="saletypeDropdown">
                        @foreach ($saletypes as $value)
                            <li>
                                <label class="dropdown-item custom-radio-label {{ request('saletype') == $value->id ? 'active' : '' }}">
                                    <input type="radio" name="saletype" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                        {{ request('saletype') == $value->id ? 'checked' : '' }}>
                                    <span class="radiomark"></span>
                                    {{ $value->title }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn btnFilter dropdown-toggle" type="button" id="constructionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Construction
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="constructionDropdown">
                        @foreach ($constructions as $value)
                            <li>
                                <label class="dropdown-item custom-radio-label {{ request('construction') == $value->id ? 'active' : '' }}">
                                    <input type="radio" name="construction" value="{{ $value->id }}" data-label="{{ $value->name }}"
                                        {{ request('construction') == $value->id ? 'checked' : '' }}>
                                    <span class="radiomark"></span>
                                    {{ $value->title }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn btnFilter btn-secondary dropdown-toggle" type="button" id="moreFiltersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        More Filters
                    </button>
                    <div class="dropdown-menu moreFilters" aria-labelledby="moreFiltersDropdown" style="min-width: 500px;">
                        <div class="wrapper-filters">
                            <ul class="nav flex-column nav-pills" id="more-filters-tab" role="tablist" aria-orientation="vertical">
                                <li><a href="#" class="nav-link active" id="tab-listedby" data-bs-toggle="pill" data-bs-target="#listedby-content" role="tab">Listed By</a></li>
                                <li><a href="#" class="nav-link" id="tab-size" data-bs-toggle="pill" data-bs-target="#size-content" type="button" role="tab">Built-up Area</a></li>
                                <li><a href="#" class="nav-link" id="tab-amenities" data-bs-toggle="pill" data-bs-target="#amenities-content" type="button" role="tab">Amenities</a></li>
                                <li><a href="#" class="nav-link" id="tab-age" data-bs-toggle="pill" data-bs-target="#age-content" type="button" role="tab">Age of Property</a></li>                                
                                <li><a href="#" class="nav-link" id="tab-facing" data-bs-toggle="pill" data-bs-target="#facing-content" type="button" role="tab">Facing</a></li>                                
                                <li><a href="#" class="nav-link" id="tab-bathrooms" data-bs-toggle="pill" data-bs-target="#bathroom-content" type="button" role="tab">Bathrooms</a></li>                                    
                            </ul>
                        
                            <div class="tab-content" id="more-filters-tabContent">
                                <!-- Listed By -->
                                <div class="tab-pane fade show active" id="listedby-content" role="tabpanel">
                                    <div class="more-filter-checkbox">
                                        <h6>Listed By</h6>
                                        @foreach ($listedTypes as $value)
                                            <label class="custom-checkbox-label {{ is_array(request('listed_type')) && in_array($value->id, request('listed_type')) ? 'active' : '' }}">
                                                <input type="checkbox" name="listed_type[]" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                                    {{ is_array(request('listed_type')) && in_array($value->id, request('listed_type')) ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                                {{ $value->title }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Size -->
                                <div class="tab-pane fade" id="size-content" role="tabpanel">
                                    <div class="more-filter-checkbox">
                                        <h6>Built-up Area in sq.ft.</h6>
                                        <form id="sizeFilterForm" method="GET" action="{{ route('properties.index') }}">
                                            <input type="hidden" name="size_min" id="size_min" value="{{ request('size_min') }}">
                                            <input type="hidden" name="size_max" id="size_max" value="{{ request('size_max') }}">
                                            <input type="text" id="sizeRange" />
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <button type="button" id="resetSizeRange" class="btn btn-secondary">Reset</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Sale type -->
                                <div class="tab-pane fade" id="amenities-content" role="tabpanel">
                                    <div class="more-filter-checkbox">
                                        <h6>Amenities</h6>
                                    </div>
                                </div>

                                <!-- Property Age -->
                                <div class="tab-pane fade" id="age-content" role="tabpanel">
                                    <div class="age-checkbox">
                                        <h6>Property Age</h6>
                                        <div class="loop-radio">
                                            @foreach ($ages as $value)
                                                <div class="individual">
                                                    <label class="custom-radio-label {{ request('age') == $value->id ? 'active' : '' }}">
                                                        <input class="hidden" type="radio" name="age" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                                            {{ request('age') == $value->id ? 'checked' : '' }}>
                                                        <span class="radiomark"></span>
                                                        {{ $value->title }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Facing -->
                                <div class="tab-pane fade" id="facing-content" role="tabpanel">
                                    Facings
                                    <div class="more-filter-checkbox">
                                        @foreach ($facings as $value)                                            
                                            <label class="custom-checkbox-label {{ is_array(request('facing')) && in_array($value->id, request('facing')) ? 'active' : '' }}">
                                                <input type="checkbox" name="facing[]" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                                    {{ is_array(request('facing')) && in_array($value->id, request('facing')) ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                                {{ $value->title }}
                                            </label>                                            
                                        @endforeach
                                    </div>
                                </div>
                                
                                <!-- Bathrooms -->
                                <div class="tab-pane fade" id="bathroom-content" role="tabpanel">
                                    <div class="more-filter-checkbox">
                                        <h6>Bathrooms</h6>
                                        @foreach ($bathrooms as $value)
                                            <label class="custom-checkbox-label {{ is_array(request('bathroom')) && in_array($value->id, request('bathroom')) ? 'active' : '' }}">
                                                <input type="checkbox" name="bathroom[]" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                                    {{ is_array(request('bathroom')) && in_array($value->id, request('bathroom')) ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                                {{ $value->title }}
                                            </label>
                                        @endforeach

                                        {{-- @foreach ($bathrooms as $bathroom)
                                            <label class="custom-checkbox-label">
                                                <input class="form-check-input" type="checkbox" name="bathroom[]" value="{{ $bathroom->id }}">
                                                <span class="checkmark"></span>
                                                {{ $bathroom->title }}
                                            </label>
                                        @endforeach --}}
                                    </div>
                                </div>

                                <div class="mt-3 text-end">
                                    <button class="btn btn-primary" id="applyFilters">Apply</button>
                                    <button class="btn btn-secondary" id="resetFilters">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                

                <select name="sort" id="sort" class="form-control">
                    <option value="1" {{ (Request::get('sort') == '1') ? 'selected' : '' }}>Latest</option>
                    <option value="0" {{ (Request::get('sort') == '0') ? 'selected' : '' }}>Oldest</option>
                </select>

                <div class="col">
                    <div style="display: none">
                        <select name="city" id="city" >
                            <option value="">City</option>
                            @if ($cities)
                                @foreach ($cities as $value)
                                    <option {{ (Request::get('city') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>    
    </form>     
</div>

<div class="body-details">
    <div class="container-fluid">        
        <ul class="breadcrumb">
            <li><a href="{{ route('front.home') }}">Home</a></li>                
            @if($citySelected)
                <li><a href="{{ url('/properties?city='.$citySelected->id) }}">{{ $citySelected->name }}</a></li>
            @endif

            @if($area)
                <li class="active" aria-current="page"> 
                    @if($room)
                        {{ $room->title }} 
                    @endif
                    Flat 
                    @if($categoryWord)
                        {{ $categoryWord }} 
                    @endif
                    in 
                    @if($area)
                        {{ $area->name }}
                    @endif
                </li>
            @endif            
        </ul>
    </div>

    <div class="row">
        <div class="col-md-8 col-12">
            @if ($properties->isNotEmpty())
                @foreach ($properties as $value)                                     
                    <div class="propery-listings">                        
                        <div class="picture">
                            @php
                                $propertyImage = $value->property_images->first();
                            @endphp
                                                        
                            <a href="{{ route('propertyDetails', $value->id) }}" >
                                @if (!empty($propertyImage->image))
                                    <img alt="" class="thumb" src="{{ asset('uploads/property/small/'.$propertyImage->image) }}" >
                                @else
                                    <img class="thumb" src="{{ asset('front-assets/images/building.svg') }}" />
                                @endif
                            </a>
                        </div>
                        
                        <div class="details">
                            <div class="first-group">
                                <div class="left">
                                    <h3 class="title">{{ $value->title }}</h3>
                                    <p>{{ $value->room->title }} {{ $value->propertyType->name }} in {{ $value->area->name }}.</p>
                                </div>
                                <div class="right">
                                    @if ($value->category->name == 'Rent')
                                        <span class="rh-ultra-featured">{{ $value->category->name }}</span>
                                    @else
                                        <span class="rh-ultra-hot">{{ $value->category->name }}</span>
                                    @endif
                                </div>                                                                                                 
                            </div>

                            <div class="second-group">
                                <p class="small-text">{{ $value->room->title }} {{ $value->propertyType->name }}</p>
                                <p>Rs.{{ $value->price }}/-</p>
                            </div>

                            <div class="third-group">
                                <p>Sizes: {{ $value->size }} sq.yd. {{ $value->handover_status }} Possession: {{ \Carbon\Carbon::parse($value->possession_date)->format('M, Y') }}</p>
                            </div>
                            
                            <div class="developer">
                                <div class="branding">
                                    <img alt="" class="logo" src="{{ asset('uploads/builder/'.$value->builder->logo) }}" >
                                    <div class="name">
                                        <p class="builder_name">{{ $value->builder->name }} </p>
                                        <p>Developer</p>  
                                    </div>                                  
                                </div>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#longModal_{{ $value->id }}" >Contact</a>  

                                <div class="modal fade" id="longModal_{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="longModalLabel">Contact Seller</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">                                            
                                                <div class="modal-builder">
                                                <h3>Contact Seller</h3>
                                                    <div class="logo-details">
                                                        <div class="logo">
                                                            <img alt="" src="{{ asset('uploads/builder/'.$value->builder->logo) }}" >
                                                        </div>
                                                        <div class="details-modal">
                                                            <h4>{{ $value->builder->name }}</h4>
                                                            <p>Developer</p>
                                                            <p>+91-{{ $value->builder->mobile }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                Please share your contact
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary">Get Contact Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>      
                @endforeach
                    {{ $properties->withQueryString()->links() }}
                @else
                    <div class="container">
                        <img src="{{ asset('front-assets/images/nodata.webp') }}" />
                    </div>
                @endif                                                                          
            </div>
            <div class="col-md-4 col-12">Right</div>
        </div>
    </div>
@endsection

@section('customJs')
<script>
function updateDropdownLabel(dropdownId, inputSelector, defaultText) {
    var checked = $(inputSelector + ':checked');
    var button = $(dropdownId);

    if (checked.length === 0) {
        button.text(defaultText);
    } else {
        var names = checked.map(function () {
            return $(this).data('label');
        }).get();
        button.text(names.join(', '));
    }
}

$('.custom-checkbox-label input').on('change', function () {
    if ($(this).is(':checked')) {
        $(this).closest('.custom-checkbox-label').addClass('active');
    } else {
        $(this).closest('.custom-checkbox-label').removeClass('active');
    }

    updateDropdownLabel('#typeDropdown', 'input[name="type[]"]', 'Property Type');
    updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'BHK Type');
    updateDropdownLabel('#bathroomDropdown', 'input[name="bathroom[]"]', 'Bathrooms');
    updateDropdownLabel('#listedTypeDropdown', 'input[name="listed_type[]"]', 'Listed By');    
    updateDropdownLabel('#facingDropdown', 'input[name="facing[]"]', 'Facings');
    updateDropdownLabel('#areasDropdown', 'input[name="areas[]"]', 'Areas');
});

// Initialize all dropdown labels on page load
updateDropdownLabel('#typeDropdown', 'input[name="type[]"]', 'Property Type');
updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'BHK Type');
updateDropdownLabel('#bathroomDropdown', 'input[name="bathroom[]"]', 'Bathrooms');
updateDropdownLabel('#listedTypeDropdown', 'input[name="listed_type[]"]', 'Listed By');
updateDropdownLabel('#facingDropdown', 'input[name="facing[]"]', 'Facings');
updateDropdownLabel('#areasDropdown', 'input[name="areas[]"]', 'Areas');
updateDropdownLabel('#saletypeDropdown', 'input[name="saletype"]', 'Sale Type');

function updateDropdownLabel(dropdownId, checkboxSelector, defaultLabel) {
    let selectedLabels = [];
    $(checkboxSelector + ':checked').each(function () {
        selectedLabels.push($(this).data('label'));
    });

    if (selectedLabels.length > 0) {
        $(dropdownId).text(selectedLabels.join(', '));
    } else {
        $(dropdownId).text(defaultLabel);
    }
}



$('.custom-radio-label input[name="saletype"]').on('change', function () {
    var name = $(this).attr('name');

    // Remove active from all radios in the group
    $('input[name="' + name + '"]').closest('.custom-radio-label').removeClass('active');

    // Add active to the selected one
    if ($(this).is(':checked')) {
        $(this).closest('.custom-radio-label').addClass('active');
    }

    // Update only the Sale Type dropdown label
    updateDropdownLabel('#saletypeDropdown', 'input[name="saletype"]', 'Sale Type');
});
</script>
@endsection