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

<tr>
    <td>
        <div class="listing-gallery" style="width: 100px;">                                
            {{-- @if(Auth::user()->role == 'Admin')
                <span class="tagUser">{{ $property?->id }}</span>
            @endif                
            <span class="tagSmall">{{ $totalImages }}</span> --}}

            @if ($data->property_images && $data->property_images->count() > 0)
                @foreach ($data->property_images->whereIn('label', ['Main', 'Video', 'Elevation', 'Bedroom']) as $propertyImage)
                    <img src="{{ asset('uploads/property/thumb/'.$propertyImage->image) }}" 
                        alt="{{ $propertyImage->label }}" class="thumb" />
                @endforeach
            @else
                <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="Default" class="thumb">
            @endif
        </div>                        
    </td>
    <td>
        <a href="{{ $property->url }}"  target="_blank" ><h5>{{ $property?->title ?? '' }}</h5></a>
        <p>{{ $property?->location ?? '' }}, {{ $property?->area?->name ?? '' }}, {{ $property?->city?->name ?? '' }}</p>
    </td>
    <td>
        @foreach($roomsArray as $room)
            @php
                $formatted = null;
                if (!empty($room['price'])) {
                    $price = (int) $room['price'];
                    if ($price >= 10000000) {
                        $formatted = number_format($price / 10000000, 1) . ' Cr';
                    } elseif ($price >= 100000) {
                        $formatted = number_format($price / 100000, 1) . ' Lacs';
                    } else {
                        $formatted = number_format($price);
                    }
                }
            @endphp

            {{ strtoupper(str_replace('_', ' ', $room['title'] ?? '')) }}
            - ₹{{ $formatted }}
            <span class="tint">{{ strtoupper($room['size'] ?? '') }} sq.ft.</span><br>
        @endforeach
    </td>

    <td>
        <div class="developer-details mt-3">
                @if($type === 'property')
                    <div class="logoFirst">
                        @if ($property->builder && $property->builder->image)
                            <img src="{{ asset('uploads/developer/thumb/' . $property->builder->image) }}" class="logo" >
                        @else
                            <img src="{{ asset('front-assets/images/default-150x150.png') }}" alt=""  class="logo" />
                        @endif

                        <div class="rollover-details">                                                                                        
                            <p class="m-0"><b>{{ $property->builder->developer_name }}</b></p>
                            <p class="m-0">E: <a href="mailto:{{ $property->builder->developer_email }}">{{ $property->builder->developer_email }}</a><br>
                                M: <a href="tel:{{ $property->builder->developer_mobile }}">{{ $property->builder->developer_mobile }}</a>
                            </p>
                        </div>
                    </div>
                @elseif($type === 'interested')
                    <div class="logoFirst">
                        @if ($property->builder && $property->builder->image)
                            <img src="{{ asset('uploads/developer/thumb/' . $property->builder->image) }}" class="logo" >
                        @else
                            <img src="{{ asset('front-assets/images/default-150x150.png') }}" alt=""  class="logo" />
                        @endif

                        <div class="rollover-details">                                                                                        
                            <p class="m-0"><b>{{ $property->builder->developer_name }}</b></p>
                            <p class="m-0">E: <a href="mailto:{{ $property->builder->developer_email }}">{{ $property->builder->developer_email }}</a><br>
                                M: <a href="tel:{{ $property->builder->developer_mobile }}">{{ $property->builder->developer_mobile }}</a>
                            </p>
                        </div>
                    </div>
                @else                
                    <div class="logoFirst">
                        @if ($property->builder && $property->builder->image)
                            <img src="{{ asset('uploads/developer/thumb/' . $property->builder->image) }}" class="logo" >
                        @else
                            <img src="{{ asset('front-assets/images/default-150x150.png') }}" alt=""  class="logo" />
                        @endif

                        <div class="rollover-details">                                                                                        
                            <p class="m-0"><b>{{ $property->builder->developer_name }}</b></p>
                            <p class="m-0">E: <a href="mailto:{{ $property->builder->developer_email }}">{{ $property->builder->developer_email }}</a><br>
                                M: <a href="tel:{{ $property->builder->developer_mobile }}">{{ $property->builder->developer_mobile }}</a>
                            </p>
                        </div>
                    </div>
                @endif

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
    </td>
    <td>
        @if($type === 'property')
            <a href="{{ route('properties.edit', $property->id) }}"><i class="fa-solid fa-pencil"></i></a>
            <a href="#" onclick="deleteProperty( {{ $property->id }} )"><i class="fa-solid fa-trash"></i></a>
        @elseif($type === 'interested')
            <a href="#" onclick="removeProperty({{ $property->id }})"><i class="fa-solid fa-trash"></i></a>
        @else                
            <a href="#" onclick="removeProperty({{ $property->id }})"><i class="fa-solid fa-trash"></i></a>
        @endif
    </td>
</tr>