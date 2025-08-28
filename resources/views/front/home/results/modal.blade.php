<div class="modal fade bd-example-modal-lg" id="big-modal_{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                                    <ul class="nav nav-tabs tagNav">
                                        <li class="nav-item"><a class="nav-link active" data-target="main">Main</a></li>
                                        <li class="nav-item"><a class="nav-link" data-target="video">Video</a></li>
                                        <li class="nav-item"><a class="nav-link" data-target="elevation">Elevation</a></li>
                                        <li class="nav-item"><a class="nav-link" data-target="bedroom">Bedroom</a></li>
                                        <li class="nav-item"><a class="nav-link" data-target="living">Living Area</a></li>
                                        <li class="nav-item"><a class="nav-link" data-target="balcony">Balcony</a></li>
                                        <li class="nav-item"><a class="nav-link" data-target="amenities">Amenities</a></li>
                                        <li class="nav-item"><a class="nav-link" data-target="floor">Floor Plan</a></li>
                                        <li class="nav-item"><a class="nav-link" data-target="location">Location Plan</a></li>
                                        <li class="nav-item"><a class="nav-link" data-target="cluster">Cluster Plan</a></li>
                                        <li class="nav-item"><a class="nav-link" data-target="contact">Contact</a></li>
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
                
                <div class="tag-container d-flex overflow-auto mt-3" style="scroll-behavior: smooth; white-space: nowrap;">
                    <div id="main" class="tag flex-shrink-0 div-active" >
                        @foreach ($properties as $value)
                            @if ($elevationImage = $value->property_images->where('label', 'Main')->first())
                                <img src="{{ asset('uploads/property/large/' . $elevationImage->image) }}" class="img-fluid" alt="Bathroom Image">
                            @endif
                        @endforeach

                        {{-- <div class="center">
                            @foreach ($properties as $value)
                                @if ($value->property_images && $value->property_images->count())
                                    @foreach ($value->property_images as $propertyImage)
                                        <div><img src="{{ asset('uploads/property/large/'.$propertyImage->image) }}" class="img-fluid" alt="Image"></div> 
                                    @endforeach
                                @endif
                            @endforeach
                        </div> --}}
                    </div>
                    
                    <div id="video" class="tag flex-shrink-0" >
                        @foreach ($properties as $value)
                            @if ($video = $value->property_images->where('label', 'Video')->first())
                                <img src="{{ asset('uploads/property/large/' . $video->image) }}" class="img-fluid" alt="Bathroom Image">
                            @endif
                        @endforeach
                    </div>
                                    
                    <div id="elevation" class="tag flex-shrink-0" >
                        @foreach ($properties as $value)
                            @if ($elevation = $value->property_images->where('label', 'Elevation')->first())
                                <img src="{{ asset('uploads/property/large/' . $elevation->image) }}" class="img-fluid" alt="Bathroom Image">
                            @endif
                        @endforeach
                    </div>

                    <div id="bedroom" class="tag flex-shrink-0">
                        @foreach ($properties as $value)
                            @if ($bathroom = $value->property_images->where('label', 'Bedroom')->first())
                                <img src="{{ asset('uploads/property/large/' . $bathroom->image) }}" class="img-fluid" alt="Bathroom Image">
                            @endif
                        @endforeach
                    </div>

                    <div id="living" class="tag flex-shrink-0">
                        @foreach ($properties as $value)
                            @if ($living = $value->property_images->where('label', 'Living')->first())
                                <img src="{{ asset('uploads/property/large/' . $living->image) }}" class="img-fluid" alt="Living Area">
                            @endif
                        @endforeach
                    </div>

                    <div id="balcony" class="tag flex-shrink-0">
                        @foreach ($properties as $value)
                            @if ($balcony = $value->property_images->where('label', 'Balcony')->first())
                                <img src="{{ asset('uploads/property/large/' . $balcony->image) }}" class="img-fluid" alt="Balcony">
                            @endif
                        @endforeach
                    </div>

                    <div id="amenities" class="tag flex-shrink-0">
                        @foreach ($properties as $value)
                            @if ($amenities = $value->property_images->where('label', 'Amenities')->first())
                                <img src="{{ asset('uploads/property/large/' . $amenities->image) }}" class="img-fluid" alt="Amenities">
                            @endif
                        @endforeach
                    </div>

                    <div id="floor" class="tag flex-shrink-0">
                        @foreach ($properties as $value)
                            @if ($floor = $value->property_images->where('label', 'Floor')->first())
                                <img src="{{ asset('uploads/property/large/' . $floor->image) }}" class="img-fluid" alt="Floor">
                            @endif
                        @endforeach
                    </div>

                    <div id="location" class="tag flex-shrink-0">
                        @foreach ($properties as $value)
                            @if ($location = $value->property_images->where('label', 'Location')->first())
                                <img src="{{ asset('uploads/property/large/' . $location->image) }}" class="img-fluid" alt="Location">
                            @endif
                        @endforeach
                    </div>

                    <div id="cluster" class="tag flex-shrink-0">
                        @foreach ($properties as $value)
                            @if ($cluster = $value->property_images->where('label', 'Cluster')->first())
                                <img src="{{ asset('uploads/property/large/' . $cluster->image) }}" class="img-fluid" alt="Cluster Plan">
                            @endif
                        @endforeach
                    </div>
                    
                    <div id="contact" class="tag flex-shrink-0">
                        <div class="contact-details-gallery">
                            <h5>Property Information</h5>

                        <div class="T_parentContainer">
                            <div class="T_heading">Property Information</div>
                            <div class="T_container">
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

                    

                <!-- Parent Gallery -->
                {{-- <div class="slider-for">
                    @foreach ($properties as $value)
                        @if ($value->property_images && $value->property_images->count())
                            @foreach ($value->property_images as $propertyImage)
                                <img src="{{ asset('uploads/property/large/'.$propertyImage->image) }}" class="img-fluid" alt="Image">                                                        
                            @endforeach
                        @endif
                    @endforeach
                </div>

                <div class="slider-nav mt-3">
                    @foreach ($properties as $value)
                        @if ($value->property_images && $value->property_images->count())
                            @foreach ($value->property_images as $propertyImage)
                                <div>
                                    <img src="{{ asset('uploads/property/thumb/'.$propertyImage->image) }}" class="img-thumbnail" alt="Thumb">
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div> --}}
            </div>
        </div>
    </div>
</div> 