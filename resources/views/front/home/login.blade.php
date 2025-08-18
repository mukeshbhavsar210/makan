<a class="btn btn-primary" href="" type="submit">Download App</a>
        <a class="btn btn-primary" href="" type="submit">List Property Free</a>

        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideModal" aria-controls="sideModal">Login</button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="sideModal" aria-labelledby="sideModalLabel">
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