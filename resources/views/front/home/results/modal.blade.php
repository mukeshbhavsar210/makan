
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
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                                    @if(Auth::check())
                                                        @if(isset($saveCount[$value->id]) && $saveCount[$value->id])                                            
                                                            <li><a href="#">Share</a></li>
                                                            <li><span class="btn btn-primary">Saved</span></li>
                                                            <li><a href="javascript:void(0)" onclick="applyProperty({{ $value->id }})"  title="I'm Interested">I'm Interested</a></li>
                                                        @else
                                                            <li><a href="javascript:void(0)" onclick="saveProperty({{ $value->id }})" title="Save Property">Save</a></li>                                                            
                                                        @endif
                                                    @else
                                                        <a href="http://127.0.0.1:8000/account/login" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                <path class="rh-ultra-light" d="M2.7 12.8C1.6 11.7 1 10.3 1 8.7s0.6-3 1.7-4.1C3.8 3.6 5.2 3 6.8 3c1.5 0 3 0.6 4.1 1.7 0.1 0.1 0.5 0.5 1.2 0.5 0.4 0 0.9-0.2 1.2-0.6 1.1-1.1 2.5-1.7 4-1.7s3 0.6 4.1 1.7C22.4 5.8 23 7.2 23 8.7s-0.6 3-1.7 4.1L12 21.6 2.7 12.8z"></path>
                                                                <path class="rh-ultra-dark" d="M17.3 4c1.3 0 2.5 0.5 3.4 1.4C21.5 6.3 22 7.5 22 8.7c0 1.3-0.5 2.4-1.4 3.3L12 20.2l-8.6-8.2C2.5 11.2 2 10 2 8.7c0-1.3 0.5-2.5 1.4-3.4C4.3 4.5 5.5 4 6.7 4 8 4 9.2 4.5 10.1 5.4 10.3 5.6 11 6.2 12 6.2c0.7 0 1.4-0.3 1.9-0.8C14.8 4.5 16 4 17.3 4M17.3 2c-1.7 0-3.5 0.7-4.8 2 -0.2 0.2-0.3 0.2-0.5 0.2 -0.3 0-0.5-0.2-0.5-0.2 -1.3-1.3-3-2-4.8-2S3.3 2.7 2 4c-2.6 2.6-2.6 6.9 0 9.5L12 23l10-9.5c2.6-2.6 2.6-6.9 0-9.5C20.7 2.7 19 2 17.3 2L17.3 2z"></path>
                                                            </svg>
                                                        </a>
                                                    @endif
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
                                        
                                        <ul class="nav nav-tabs tagNav" id="tag-nav-{{ $value->id }}">
                                            @foreach ($sections as $id => $media)
                                                @if ($media) 
                                                    <li class="nav-item">
                                                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-target="{{ $id }}-{{ $value->id }}">
                                                            {{ ucfirst($id) }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
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
                        @foreach ($sections as $id => $media)
                            @if ($media)
                                <div id="{{ $id }}-{{ $value->id }}" class="tag flex-shrink-0 {{ $loop->first ? 'div-active' : '' }}">
                                    <img src="{{ asset('uploads/property/' . $media->image) }}" class="img-fluid" alt="{{ $value->title ?? ucfirst($id) }}">
                                </div>
                            @endif
                        @endforeach

                        <div id="contact-{{ $value->id }}" class="tag flex-shrink-0">
                            <div class="contact-details-gallery">
                                <h5>Property Information</h5>

                                <div class="property-modal-details">      
                                    <div class="part">
                                        @php                                       
                                            $roomsArray = json_decode($value->rooms, true) ?? [];
                                        @endphp

                                        @if(!empty($roomsArray))
                                            @foreach($roomsArray as $room)
                                                {{ isset($room['size']) ? strtoupper(str_replace('_', ' ', $room['size'])) : '' }} -
                                            @endforeach
                                            sq.ft.
                                        @endif  
                                        <p class="small-text">Size</p>
                                    </div>

                                    <div class="part">
                                        5 Buildings - 699 units
                                        <p class="small-text">Project Size</p>
                                    </div>

                                    <div class="part">
                                         @php
                                            $roomsArray = json_decode($value->rooms, true) ?? [];
                                            $totalPrice = 0;
                                            $totalSize  = 0;

                                            foreach ($roomsArray as $room) {
                                                $price = isset($room['price']) ? (float) $room['price'] : 0;
                                                $size  = isset($room['size']) ? (float) $room['size'] : 0;

                                                $totalPrice += $price;
                                                $totalSize  += $size;
                                            }

                                            $overallPricePerSqft = ($totalPrice > 0 && $totalSize > 0)
                                                ? round($totalPrice / $totalSize, 2)
                                                : 0;
                                        @endphp

                                        @if($overallPricePerSqft > 0)
                                             ₹{{ number_format($overallPricePerSqft) }}/sq.ft.
                                        @endif
                                        <p class="small-text">Average Price:</p>
                                    </div>

                                    <div class="part">
                                        @php                                       
                                            $roomsArray = json_decode($value->rooms, true) ?? [];
                                        @endphp

                                        @if(!empty($roomsArray))
                                            @foreach($roomsArray as $room)
                                                {{ isset($room['title']) ? preg_replace('/[^0-9]/', '', $room['title']) : '' }},
                                            @endforeach
                                        @endif
                                        BHK 
                                        @php
                                            $types = json_decode($value->property_types, true) ?? [];
                                        @endphp
                                        {{ implode(', ', array_map('ucwords', $types)) }}
                                        <p class="small-text">BHK</p>
                                    </div>

                                    <div class="part">                                       
                                        @php
                                            $date = \Carbon\Carbon::parse($value->possession_date);
                                        @endphp
                                        {{ $date->year == now()->year ? $date->format('M') : $date->format('M, Y') }}
                                        <p class="small-text">Possession</p>
                                    </div>     
                                </div>

                                <div class="property-modal-developer">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>Contact Sellers in</p>
                                            <div class="developer">
                                                @if ($value->builder && $value->builder->image)
                                                    <img src="{{ asset('uploads/builder/' . $value->builder->image) }}" class="logo" >
                                                    <p class="builder_name">{{ $value->builder->developer_name }}</p>
                                                @else
                                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="logo" />
                                                @endif
                                            </div>
                                            <div class="form">
                                                <p class="small-font">Please share your contact</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btm-text">
                                        <span>I agree to be contacted by Housing and agents via</span>, WhatsApp, SMS, phone, email etc</span>
                                        <button class="btn btn-primary">Get Contact Details</button>
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