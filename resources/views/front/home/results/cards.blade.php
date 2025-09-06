@if ($properties->isNotEmpty())
                @foreach ($properties as $value)      
                    <div class="propery-listings">                        
                        <div class="picture">
                            @php
                                $created = \Carbon\Carbon::parse($value->created_at);
                                $now = \Carbon\Carbon::now();

                                $diffInDays = $created->diffInDays($now);
                                $diffInWeeks = $created->diffInWeeks($now);
                                $diffInMonths = $created->diffInMonths($now);

                                if ($diffInMonths > 0) {
                                    $timeAgo = $diffInMonths . 'm';
                                } elseif ($diffInWeeks > 0) {
                                    $timeAgo = $diffInWeeks . 'w';
                                } elseif ($diffInDays > 0) {
                                    $timeAgo = $diffInDays . 'd';
                                } else {
                                    $timeAgo = 'Today';
                                }
                            @endphp

                            <p class="posted-status">
                                {{ $timeAgo }} @if($timeAgo !== 'Today') ago @endif
                            </p>

                            <div class="media-overlay" data-bs-toggle="modal" data-bs-target="#big-modal_{{ $value->id }}"></div>
                            <div class="listing-gallery" >                                
                               @if ($value->property_images && $value->property_images->count())
                                    @foreach ($value->property_images->whereIn('label', ['Main', 'Video', 'Elevation', 'Bedroom']) as $propertyImage)
                                        <img src="{{ asset('uploads/property/thumb/'.$propertyImage->image) }}" alt="{{ $propertyImage->label }}" height="100" width="100">
                                    @endforeach
                                @else
                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="Default" height="100" width="100">
                                @endif
                            </div>
                        </div>

                        @include('front.home.results.modal')
                        
                        <div class="details">
                            <div class="first-group">
                                <div class="left">         
                                    <a href="{{ $value->url }}" onclick="visitedProperty({{ $value->id }})" class="product-link" target="_blank">
                                        <h3 class="title">{{ $value->title }}
                                            <div class="rera" style="{{ empty($value->rera) ? 'display:none;' : '' }}">
                                                <img class="icon" src="{{ asset('front-assets/images/tick.svg') }}" /> RERA
                                            </div>
                                        </h3>                                                                            
                                        <h5>
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

                                            @if ($value->category == 'buy')
                                                <span class="rh-ultra-featured">Sale</span>
                                            @else
                                                <span class="rh-ultra-hot">Rent</span>
                                            @endif

                                            in {{ $value->area->name }}.
                                        </h5>
                                    </a>
                                </div>
                                <div class="right">
                                    @if(Auth::check())
                                        @if(isset($saveCount[$value->id]) && $saveCount[$value->id])                                            
                                            <i class="fa-solid fa-heart saved"></i>
                                        @else
                                            <a href="javascript:void(0)" onclick="saveProperty({{ $value->id }})" class="favorite add-to-favorite user_not_logged_in rh-ui-tooltip" title="Add to favorites">
                                                <div class="stage">
                                                    <div class="heart"></div>
                                                </div>
                                            </a> 
                                            <div id="notification" class="notification">Saved</div>                 
                                        @endif
                                    @else
                                        <a href="http://127.0.0.1:8000/account/login" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path class="rh-ultra-light" d="M2.7 12.8C1.6 11.7 1 10.3 1 8.7s0.6-3 1.7-4.1C3.8 3.6 5.2 3 6.8 3c1.5 0 3 0.6 4.1 1.7 0.1 0.1 0.5 0.5 1.2 0.5 0.4 0 0.9-0.2 1.2-0.6 1.1-1.1 2.5-1.7 4-1.7s3 0.6 4.1 1.7C22.4 5.8 23 7.2 23 8.7s-0.6 3-1.7 4.1L12 21.6 2.7 12.8z"></path>
                                                <path class="rh-ultra-dark" d="M17.3 4c1.3 0 2.5 0.5 3.4 1.4C21.5 6.3 22 7.5 22 8.7c0 1.3-0.5 2.4-1.4 3.3L12 20.2l-8.6-8.2C2.5 11.2 2 10 2 8.7c0-1.3 0.5-2.5 1.4-3.4C4.3 4.5 5.5 4 6.7 4 8 4 9.2 4.5 10.1 5.4 10.3 5.6 11 6.2 12 6.2c0.7 0 1.4-0.3 1.9-0.8C14.8 4.5 16 4 17.3 4M17.3 2c-1.7 0-3.5 0.7-4.8 2 -0.2 0.2-0.3 0.2-0.5 0.2 -0.3 0-0.5-0.2-0.5-0.2 -1.3-1.3-3-2-4.8-2S3.3 2.7 2 4c-2.6 2.6-2.6 6.9 0 9.5L12 23l10-9.5c2.6-2.6 2.6-6.9 0-9.5C20.7 2.7 19 2 17.3 2L17.3 2z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>                                                                                                 
                            </div>  

                            <div class="second-group">
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
                                    @foreach($roomsArray as $room)
                                        <div class="room-item">
                                            <p>{{ isset($room['title']) ? strtoupper(str_replace('_', ' ', $room['title'])) : '' }} ({{ isset($room['size']) ? strtoupper(str_replace('_', ' ', $room['size'])) : '' }} sq.ft.)</p>
                                            @if(!empty($room['price']))
                                                <p class="price">₹{{ $formatPrice($room['price']) }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="third-group">
                                <p>
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
                                        Avg. Price: ₹{{ number_format($overallPricePerSqft) }}/sq.ft.
                                    @endif

                                    • Sizes: 
                                    @php                                       
                                        $roomsArray = json_decode($value->rooms, true) ?? [];
                                    @endphp

                                    @if(!empty($roomsArray))
                                        @foreach($roomsArray as $room)
                                            {{ isset($room['size']) ? strtoupper(str_replace('_', ' ', $room['size'])) : '' }} -
                                        @endforeach
                                        sq.ft.
                                    @endif                                        

                                    @php
                                        $constructionLabels = [
                                            'under' => 'Under Construction',
                                            'ready' => 'Ready to Move',                                                
                                        ];
                                    @endphp

                                    • {{ $constructionLabels[$value->construction_types] ?? ucfirst($value->construction_types) }}

                                    • {{ $value->handover_status }} Possession: 
                                    @php
                                        $date = \Carbon\Carbon::parse($value->possession_date);
                                    @endphp
                                    {{ $date->year == now()->year ? $date->format('M') : $date->format('M, Y') }}
                                </p>
                            </div>                        
                            
                            <div class="developer">
                                <div class="branding">
                                    @if ($value->builder && $value->builder->image)
                                        <img src="{{ asset('uploads/developer/' . $value->builder->image) }}" class="logo" >
                                        <div class="name">
                                            <p class="builder_name">{{ $value->builder->developer_name }}</p>
                                            <p>{{ $value->user->role }}</p>  
                                        </div>                                  
                                    @else
                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="logo" />
                                    @endif
                                </div>

                               @if(Auth::check())
                                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#longModal_{{ $value->id }}">Contact</a>  
                                @else
                                    <a href="http://127.0.0.1:8000/account/login" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm">Contact</a>
                                @endif                                                                

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
                                                        @if ($value->builder && $value->builder->image)
                                                            <div class="logo">
                                                                <img src="{{ asset('uploads/builder/' . $value->builder->image) }}" class="logo" >
                                                            </div>
                                                            <div class="details-modal">
                                                                <h4>{{ $value->builder->developer_name }}</h4>
                                                                <p>{{ $value->user->role }}</p>  
                                                                <p>M. {{ $value->builder->developer_mobile }}</p>
                                                            </div>                                  
                                                        @else
                                                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="logo" />
                                                        @endif
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