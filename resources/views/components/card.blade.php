@props([
    'data',
    'type' => 'property',
    'extra' => []
])

@php
    $property = $type === 'property' ? $data : $data->property; // always get property
    $PropertyImage = $property?->property_images->where('label', 'Main')->first() ?? null;
    $totalImages   = $property?->property_images->count() ?? 0;
    $roomsArray    = json_decode($property?->rooms ?? '[]', true);
@endphp

<div class="col-md-3 col-12">
    @if($type === 'property')         
        <div class="listings-posted {{ $property->verification == 'approved' ? 'approved' : 'pending' }}">
            <div class="link">            
                <div class="overlay-details-top">
                    @if(Auth::user()->role == 'Admin')
                        <div class="avatar-stack">
                            <div class="avatar-wrapper">
                                <span class="tagUser">{{ $property?->id }}</span>
                                <div class="avatar-tooltip" style="bottom: -35px; left:20px;">Property ID</div>
                            </div>
                        </div>                    
                    @endif 
                    @if ($data->property_images && $data->property_images->count() > 0)               
                        <div class="avatar-stack">
                            <div class="avatar-wrapper">
                                <span class="tagSmall">{{ $totalImages }}</span>
                                <div class="avatar-tooltip" style="bottom: -35px; left:10px;">Uploaded Images</div>
                            </div>
                        </div>
                    @endif 
                </div>
                <div class="overlay-details-btm">
                    <div>
                        @if($type === 'property')
                            @if($property->verification ==  'approved')
                                <div class="avatar-stack">
                                    <div class="avatar-wrapper">
                                        <i class="fa-solid fa-circle-check tick-icon-active"></i>
                                        <div class="avatar-tooltip" style="bottom: 0; left:55px;">Active</div>
                                    </div>
                                </div>                             
                            @else
                                <div class="avatar-stack">
                                    <div class="avatar-wrapper">
                                        <i class="fa-solid fa-circle-check tick-icon"></i>
                                        <div class="avatar-tooltip" style="bottom: 0; left:55px;">In-Active</div>
                                    </div>
                                </div>                            
                            @endif                                    
                        @endif                    
                    </div>
                    <div>                    
                        @if($type === 'property')  
                            @if($property->verification ==  'approved')
                                <div class="flex-wrapper">
                                    <div class="avatar-stack">
                                        <div class="avatar-wrapper">
                                            <a href="{{ route('properties.edit', $property->id) }}"><i class="fa-solid fa-pencil"></i></a>
                                            <div class="avatar-tooltip" style="bottom: -3px; left:-20px;">Edit</div>
                                        </div>
                                    </div> 
                                    <div class="avatar-stack">
                                        <div class="avatar-wrapper">
                                            <a href="#" onclick="deleteProperty({{ $property->id }})"><i class="fa-solid fa-trash"></i></a>
                                            <div class="avatar-tooltip" style="bottom: -3px; left:-25px;">Delete</div>
                                        </div>
                                    </div>                
                                </div>  
                            @endif                                   
                        @elseif($type === 'interested')
                            <div class="avatar-stack">
                                <div class="avatar-wrapper">
                                    <a href="#" onclick="removeProperty({{ $property->id }})"><i class="fa-solid fa-trash"></i></a>
                                    <div class="avatar-tooltip" style="bottom: -3px; left:-25px;">Delete</div>
                                </div>
                            </div> 
                        @else    
                            <div class="avatar-stack">
                                <div class="avatar-wrapper">
                                    <a href="#" onclick="removeProperty({{ $property->id }})"><i class="fa-solid fa-trash"></i></a>
                                    <div class="avatar-tooltip" style="bottom: -3px; left:-25px;">Delete</div>
                                </div>
                            </div>                                    
                        @endif
                    </div>
                </div>

                @php
                    $propertyImages = $property?->images?->take(4);
                @endphp
                
                <a href="{{ $property->url }}"  target="_blank" class="overlay"></a>
                @if ($propertyImages && $propertyImages->count() > 0)
                    <div class="listing-gallery">
                        @foreach ($propertyImages as $image)
                            @if (!empty($image->image))
                                <img src="{{ asset('uploads/property/thumb/'.$image->image) }}" class="thumb" alt="{{ $property?->title ?? '' }}" >
                            @else
                                <img src="{{ asset('front-assets/images/default-150x150.png') }}" alt="" class="thumb">
                            @endif
                        @endforeach
                    </div>
                @else
                    <img src="{{ asset('front-assets/images/default-150x150.png') }}" alt="" class="thumb">
                @endif
            </div>

            @if($property->verification ==  'approved')
                <div class="details">
                    <h3 class="mb-1">
                        {{ $property?->title ?? '' }}
                    </h3>
                    <p class="m-0">
                        {{ $property?->location ?? '' }}, {{ $property?->area?->name ?? '' }}, {{ $property?->city?->name ?? '' }}
                    </p>
                    <hr>

                    <div class="flex-wrapper">
                        @foreach($roomsArray as $room)
                            @php
                                $formatted = null;
                                if (!empty($room['price'])) {
                                    $price = (int) $room['price'];
                                    if ($price >= 10000000) {
                                        $formatted = number_format($price / 10000000, 1) . ' Cr';
                                    } elseif ($price >= 100000) {
                                        $formatted = number_format($price / 100000, 1) . ' L';
                                    } else {
                                        $formatted = number_format($price);
                                    }
                                }
                            @endphp
                        
                            <div class="avatar-stack">
                                <div class="avatar-wrapper">
                                    {{ strtoupper(str_replace('_', ' ', $room['title'] ?? '')) }}
                                    <div class="avatar-tooltip" style="bottom: 23px; left:25px;">₹{{ $formatted }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>   

                    <div class="developer-details">
                        <div class="avatar-wrapper">
                            @if ($property->builder && $property->builder->image)
                                <img src="{{ asset('uploads/developer/thumb/' . $property->builder->image) }}" alt="{{ $property->builder->developer_name }}" class="avatar-logo" >
                            @else
                                <img src="{{ asset('front-assets/images/user.png') }}" alt="" class="avatar-logo" />
                            @endif
                            <div class="avatar-tooltip">
                                <p class="m-0"><b>{{ $property->builder->developer_name }}</b></p>
                                <p class="m-0">E: <a href="mailto:{{ $property->builder->developer_email }}">{{ $property->builder->developer_email }}</a><br>
                                    M: <a href="tel:{{ $property->builder->developer_mobile }}">{{ $property->builder->developer_mobile }}</a>
                                </p>
                            </div>
                        </div>                

                        <div class="mt-2 flex-wrapper">
                            @if($type === 'property')
                                @if($property->applications->count() > 0)
                                    <div class="avatar-stack">
                                        @foreach($property->applications->take(1) as $application)
                                            @php $user = $application->user; @endphp
                                            <div class="avatar-wrapper" data-bs-toggle="modal" data-bs-target="#propertyInterestedModal_{{ $property->id }}">
                                                <img src="{{ $user->image ? asset('uploads/profile/thumb/' . $user->image) : asset('front-assets/images/user.png') }}" 
                                                    alt="{{ $user->name }}" class="avatar">
                                                <div class="avatar-tooltip">
                                                    <strong>{{ $user->name }}</strong><br>
                                                    {{ $user->role }}
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($property->applications->count() > 1)
                                            <div class="avatar-wrapper more">
                                                +{{ $property->applications->count() - 1 }}
                                            </div>
                                        @endif
                                    </div>
                                
                                    <div class="modal fade" id="propertyInterestedModal_{{ $property->id }}" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content login-modal">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="modal-header">
                                                    Contacted <span class="counts">{{ $property->applications->count() }}</span>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="user-listings">
                                                        @foreach($property->applications as $application)
                                                            @php $user = $application->user; @endphp
                                                            <div class="row mb-2">
                                                                <div class="col-md-2">
                                                                    <img src="{{ $user->image ? asset('uploads/profile/thumb/' . $user->image) : asset('front-assets/images/user.png') }}" alt="{{ $user->name }}" class="photo">
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <strong>{{ $user->name }}</strong><br>
                                                                    {{ $user->role }}<br>
                                                                    <a href="mailto:{{ $user->email }}">Email: {{ $user->email }}</a><br>
                                                                    <a href="tel:{{ $user->mobile }}">Mobile {{ $user->mobile }}</a>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                            
                                @endif 
                                @if($property->savedUsers->count() > 0)
                                    <div class="avatar-stack">
                                        @foreach($property->savedUsers->take(1) as $saved)
                                            <div class="avatar-wrapper" data-bs-toggle="modal" data-bs-target="#propertySavedModal_{{ $property->id }}">
                                                @if (!empty($saved->user->image))
                                                    <img src="{{ asset('uploads/profile/thumb/' . $saved->user->image) }}" alt="{{ $saved->user->name }}" class="avatar">
                                                @else
                                                    <img src="{{ asset('front-assets/images/user.png') }}" alt="{{ $saved->user->name }}" class="avatar">
                                                @endif

                                                <div class="avatar-tooltip">
                                                    <strong>{{ $saved->user->name }}</strong><br>
                                                    {{ $saved->user->role }}
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($property->savedUsers->count() > 1)
                                            <div class="avatar-wrapper more">
                                                +{{ $property->savedUsers->count() - 1 }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="modal fade bd-example-modal-lg" id="propertySavedModal_{{ $property->id }}" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content login-modal">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="modal-header">Saved <span class="counts">{{ $property->savedUsers->count() > 0 ? $property->savedUsers->count() : '' }}</span></div>
                                                <div class="modal-body">
                                                    <div class="user-listings">
                                                        @foreach($property->savedUsers as $saved)
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    @if (!empty($saved->user->image))
                                                                        <img src="{{ asset('uploads/profile/thumb/' . $saved->user->image) }}" alt="{{ $saved->user->name }}" class="photo">
                                                                    @else
                                                                        <img src="{{ asset('front-assets/images/user.png') }}" alt="" class="photo" />
                                                                    @endif                
                                                                </div>                                    
                                                                <div class="col-md-10">
                                                                    <strong>{{ $saved->user->name }}</strong><br>
                                                                    {{ $saved->user->role }}<br>
                                                                    <a href="mailto:{{ $saved->user->email }}">{{ $saved->user->email }}</a><br>
                                                                    <a href="tel:{{ $saved->user->mobile }}">{{ $saved->user->mobile }}</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif 
                            @elseif($type === 'interested')
                                @if($property->applications->count() > 0)
                                    <div class="avatar-stack">
                                        @foreach($property->applications->take(3) as $application)
                                            @php $user = $application->user; @endphp
                                            <div class="avatar-wrapper" data-bs-toggle="modal" data-bs-target="#propertyInterestedModal_{{ $property->id }}">
                                                <img src="{{ $user->image ? asset('uploads/profile/thumb/' . $user->image) : asset('front-assets/images/user.png') }}" 
                                                    alt="{{ $user->name }}" class="avatar">
                                                <div class="avatar-tooltip">
                                                    <strong>{{ $user->name }}</strong><br>
                                                    {{ $user->role }}
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($property->applications->count() > 3)
                                            <div class="avatar-wrapper more">
                                                +{{ $property->applications->count() - 3 }}
                                            </div>
                                        @endif
                                    </div>
                                
                                    <div class="modal fade" id="propertyInterestedModal_{{ $property->id }}" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content login-modal">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="modal-header">
                                                    Contacted <span class="counts">{{ $property->applications->count() }}</span>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="user-listings">
                                                        @foreach($property->applications as $application)
                                                            @php $user = $application->user; @endphp
                                                            <div class="row mb-2">
                                                                <div class="col-md-2">
                                                                    <img src="{{ $user->image ? asset('uploads/profile/thumb/' . $user->image) : asset('front-assets/images/user.png') }}" alt="{{ $user->name }}" class="photo">
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <strong>{{ $user->name }}</strong><br>
                                                                    {{ $user->role }}<br>
                                                                    <a href="mailto:{{ $user->email }}">Email: {{ $user->email }}</a><br>
                                                                    <a href="tel:{{ $user->mobile }}">Mobile {{ $user->mobile }}</a>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                            
                                @endif                        
                            @else     
                                @if($property->savedUsers->count() > 0)
                                    <div class="avatar-stack">
                                        @foreach($property->savedUsers->take(3) as $saved)
                                            <div class="avatar-wrapper" data-bs-toggle="modal" data-bs-target="#propertySavedModal_{{ $property->id }}">
                                                @if (!empty($saved->user->image))
                                                    <img src="{{ asset('uploads/profile/thumb/' . $saved->user->image) }}" 
                                                        alt="{{ $saved->user->name }}" 
                                                        class="avatar">
                                                @else
                                                    <img src="{{ asset('front-assets/images/user.png') }}" 
                                                        alt="{{ $saved->user->name }}" 
                                                        class="avatar">
                                                @endif

                                                <div class="avatar-tooltip">
                                                    <strong>{{ $saved->user->name }}</strong><br>
                                                    {{ $saved->user->role }}
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($property->savedUsers->count() > 3)
                                            <div class="avatar-wrapper more">
                                                +{{ $property->savedUsers->count() - 3 }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="modal fade bd-example-modal-lg" id="propertySavedModal_{{ $property->id }}" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content login-modal">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="modal-header">Saved <span class="counts">{{ $property->savedUsers->count() > 0 ? $property->savedUsers->count() : '' }}</span></div>
                                                <div class="modal-body">
                                                    <div class="user-listings">
                                                        @foreach($property->savedUsers as $saved)
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    @if (!empty($saved->user->image))
                                                                        <img src="{{ asset('uploads/profile/thumb/' . $saved->user->image) }}" alt="{{ $saved->user->name }}" class="photo">
                                                                    @else
                                                                        <img src="{{ asset('front-assets/images/user.png') }}" alt="" class="photo" />
                                                                    @endif                
                                                                </div>                                    
                                                                <div class="col-md-10">
                                                                    <strong>{{ $saved->user->name }}</strong><br>
                                                                    {{ $saved->user->role }}<br>
                                                                    <a href="mailto:{{ $saved->user->email }}">{{ $saved->user->email }}</a><br>
                                                                    <a href="tel:{{ $saved->user->mobile }}">{{ $saved->user->mobile }}</a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif                                   
                            @endif  
                        </div>
                    </div>
                </div>
            @else
                <div class="details">
                    <h3 class="mb-1">{{ $property?->title ?? '' }}</h3>
                    <h6 class="mt-3">Under Verification</h6>
                </div>
            @endif            
        </div>               
    @endif
</div>