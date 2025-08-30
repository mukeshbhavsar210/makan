
@foreach ($properties as $value)
    @php
        $elevationImage = $value->property_images->where('label', 'Main')->first();
        $video = $value->property_images->where('label', 'Video')->first();
        $elevation = $value->property_images->where('label', 'Elevation')->first();
        $bathroom = $value->property_images->where('label', 'Bedroom')->first();
        $living = $value->property_images->where('label', 'Living')->first();
        $balcony = $value->property_images->where('label', 'Balcony')->first();
        $amenities = $value->property_images->where('label', 'Amenities')->first();
        $floor = $value->property_images->where('label', 'Floor')->first();
        $location = $value->property_images->where('label', 'Location')->first();
        $cluster = $value->property_images->where('label', 'Cluster')->first();
    @endphp

    <div class="modal fade bd-example-modal-lg" id="big-modal_{{ $value->id }}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">                    
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z" fill="#ffffff"/>
                    </svg>
                </button>
                <div class="modal-body">
                    <div class="gallery-title">
                        <div class="container">
                            <div class="tag-module">
                                <div class="row">
                                    <div class="col-md-10 col-12">
                                        <div class="title">
                                            <div class="title-h4">
                                                <h4>{{ $value->title }}</h4>
                                                <ul class="share-save">
                                                    <li><a href="#">Share</a></li>
                                                    <li><a href="#">Save</a></li>
                                                </ul>
                                            </div>

                                            <div class="right-gallery-pagination">
                                                <div class="slick-info">
                                                    <div class="text">
                                                        <span class="counter-current">1</span>/<span class="counter-total">0</span>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="slick-progress progress-bar bg-primary" role="progressbar" style="width:0%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @php                                       
                                            $roomsArray = json_decode($value->rooms, true) ?? [];
                                            $propertyTypes = json_decode($value->property_types, true) ?? [];

                                            $formatPrice = function ($price) {
                                                if ($price >= 10000000) {
                                                    return number_format($price / 10000000, 1) . ' Cr';
                                                } elseif ($price >= 100000) {
                                                    return number_format($price / 100000, 1) . ' Lacs';
                                                } else {
                                                    return number_format($price);
                                                }
                                            };
                                        @endphp

                                        @if(!empty($roomsArray))
                                            <div class="room-item">
                                                @foreach($roomsArray as $room)
                                                    <div class="room">
                                                        <span>{{ isset($room['title']) ? strtoupper(str_replace('_', ' ', $room['title'])) : '' }} </span>
                                                        @if(!empty($room['price']))
                                                            <span>₹{{ $formatPrice($room['price']) }}</span>,
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif                                   

                                        <ul class="nav nav-tabs tagNav" id="tag-nav-{{ $value->id }}">
                                            <li class="nav-item"><a class="nav-link active" data-target="main-{{ $value->id }}">Main</a></li>
                                            <li class="nav-item"><a class="nav-link" data-target="video-{{ $value->id }}">Video</a></li>
                                            <li class="nav-item"><a class="nav-link" data-target="elevation-{{ $value->id }}">Elevation</a></li>
                                            <li class="nav-item"><a class="nav-link" data-target="bedroom-{{ $value->id }}">Bedroom</a></li>
                                            <li class="nav-item"><a class="nav-link" data-target="living-{{ $value->id }}">Living Area</a></li>
                                            <li class="nav-item"><a class="nav-link" data-target="balcony-{{ $value->id }}">Balcony</a></li>
                                            <li class="nav-item"><a class="nav-link" data-target="amenities-{{ $value->id }}">Amenities</a></li>
                                            <li class="nav-item"><a class="nav-link" data-target="floor-{{ $value->id }}">Floor Plan</a></li>
                                            <li class="nav-item"><a class="nav-link" data-target="location-{{ $value->id }}">Location Plan</a></li>
                                            <li class="nav-item"><a class="nav-link" data-target="cluster-{{ $value->id }}">Cluster Plan</a></li>
                                            <li class="nav-item"><a class="nav-link" data-target="contact-{{ $value->id }}">Contact</a></li>
                                        </ul>
                                    </div>                            
                                    <div class="col-md-2 col-12">
                                        <ul class="nav nav-tabs tagNav">
                                            <li><a class="nav-link" data-target="contact">Contact Seller</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tag-container d-flex overflow-auto mt-3" id="tag-container-{{ $value->id }}" style="scroll-behavior: smooth; white-space: nowrap;">
                        @php
                            $sections = [
                                'main'      => $elevationImage ?? null,
                                'video'     => $video ?? null,
                                'elevation' => $elevation ?? null,
                                'bedroom'   => $bathroom ?? null,
                                'living'   => $living ?? null,
                                'balcony'   => $balcony ?? null,
                                'amenities'   => $amenities ?? null,
                                'floor'   => $floor ?? null,
                                'location'   => $location ?? null,
                                'cluster'   => $cluster ?? null,
                            ];
                        @endphp

                        @foreach ($sections as $id => $media)
                            <div id="{{ $id }}-{{ $value->id }}" class="tag flex-shrink-0 {{ $loop->first ? 'div-active' : '' }}">
                                @if ($media)
                                    <img src="{{ asset('uploads/property/large/' . $media->image) }}" class="img-fluid" alt="{{ $value->title ?? ucfirst($id) }}">
                                @else
                                    <img src="{{ asset('uploads/property/placeholder.jpg') }}" class="img-fluid" alt="No Image">
                                @endif
                            </div>
                        @endforeach

                        <div id="contact-{{ $value->id }}" class="tag flex-shrink-0">
                            <div class="contact-details-gallery">
                                <h5>Property Information</h5>
                                <div class="T_itemContainer">
                                    <div class="T_iconStyle"></div>
                                    <div class="T_itemStyle">
                                        <div class="T_textEllipsis">2.14 Acres</div><div class="T_textEllipsis _sq1l2s _vv1q9c _ks15vq T_titlestyle _7lc65e _g31fwx _c819bv _cs1nn1">Project Area</div></div></div><div class="T_itemContainer _giy749 _jbllbu _ks15vq _l819bv _9s1txw _arvrvc _5jftgi _e21a70 _261mbq"><div class="_vyl52n _e2l52n _lzn0w4qz _bof91jbn _1y0k1gkc T_iconStyle"></div><div class="T_itemStyle _gz1fwx _0h1y6m _0f1h6o _ar1bp4 _9s1txw _vy1osq"><div class="T_textEllipsis _sq1l2s _vv1q9c _ks15vq T_propertyValueStyle _7lc65e _csbfng _g3exct _c8dlk8">991 sq.ft.</div><div class="T_textEllipsis _sq1l2s _vv1q9c _ks15vq T_titlestyle _7lc65e _g31fwx _c819bv _cs1nn1">Size</div></div></div><div class="T_itemContainer _giy749 _jbllbu _ks15vq _l819bv _9s1txw _arvrvc _5jftgi _e21a70 _261mbq"><div class="_vyl52n _e2l52n _lzn0w4qz _bof91jbn _1y0k1gkc T_iconStyle"></div><div class="T_itemStyle _gz1fwx _0h1y6m _0f1h6o _ar1bp4 _9s1txw _vy1osq"><div class="T_textEllipsis _sq1l2s _vv1q9c _ks15vq T_propertyValueStyle _7lc65e _csbfng _g3exct _c8dlk8">5 Buildings - 250 units</div><div class="T_textEllipsis _sq1l2s _vv1q9c _ks15vq T_titlestyle _7lc65e _g31fwx _c819bv _cs1nn1">Project Size</div></div></div><div class="T_itemContainer _giy749 _jbllbu _ks15vq _l819bv _9s1txw _arvrvc _5jftgi _e21a70 _261mbq"><div class="_vyl52n _e2l52n _lzn0w4qz _bof91jbn _1y0k1gkc T_iconStyle"></div>
                                        <div class="T_itemStyle _gz1fwx _0h1y6m _0f1h6o _ar1bp4 _9s1txw _vy1osq">
                                            <div class="T_propertyValueStyle">₹9.79 K/sq.ft</div>
                                        <div class="T_textEllipsis">Average Price</div>
                                            </div>
                                        </div>
                                            <div class="T_itemContainer">
                                                <div class="T_iconStyle"></div>
                                            <div class="T_itemStyle">
                                                <div class="T_propertyValueStyle">3 BHK Flat</div>
                                            <div class="T_textEllipsis">BHK</div></div></div>
                                                <div class="T_itemContainer">
                                                <div class="T_iconStyle"></div>
                                            <div class="T_itemStyle">
                                                <div class="T_propertyValueStyle">Ready to Move</div>
                                            <div class="T_textEllipsis">Possession</div>
                                        </div>
                                    </div>
                            </div>                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach