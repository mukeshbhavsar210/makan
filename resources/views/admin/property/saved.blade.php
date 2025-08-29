@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Saved Properties 
                    @if(Auth::user()->role == 'Admin')
                        <span class="badge rounded text-blue bg-blue-subtle">{{ $all_counts }}</span>
                    @else
                        <span class="badge rounded text-blue bg-blue-subtle">{{ $counts }}</span>
                    @endif
                </h1>
            </div>  
            <div class="col-sm-6">
                <form action="" method="get" class="part">
                    <div class="search-top">
                        <div class="input-group input-group" style="width: 250px;">
                            <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary icon-btn"><i class="iconoir-search"></i></button>
                            </div>
                        </div>
                        
                        <button type="button" onclick="window.location.href='{{ route('property.savedProperties') }}'" class="btn icon-btn"><i class="las la-undo-alt"></i></button>
                    </div>
                </form>
            </div>                       
        </div>
    </div>
</section>

<section class="section-5 bg-2">
    <div class="container-fluid">
    @include('admin.layouts.message')

    <div class="card">
        <div class="card-body table-responsive">
            <div class="table-responsive browser_users">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="border-top-0">Project Name</th>
                            <th class="border-top-0">BHK</th>                            
                            <th class="border-top-0">Price</th>
                            <th class="border-top-0">Developer</th>                            
                            <th class="border-top-0">Interested</th>
                            <th class="border-top-0">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(Auth::user()->role == 'Admin')
                            @if ($all_saved->isNotEmpty())
                                @foreach ($all_saved as $value)
                                    <tr>
                                        <td class="px-0">
                                            <div class="d-flex align-items-center">
                                                @php
                                                    $PropertyImage = $value->property->property_images->first();
                                                @endphp
                                                <a href="{{ route('propertyDetails', $value->property_id) }}" class="thumb">
                                                    <span class="property-id">{{ $value->id }}</span>
                                                    @if ($PropertyImage && !empty($PropertyImage->image))
                                                        <img src="{{ asset('uploads/property/small/' . $PropertyImage->image) }}"  height="100" width="100" class="me-2 align-self-center rounded" >
                                                    @else
                                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" height="100" width="100" class="me-2 align-self-center rounded" >
                                                    @endif
                                                </a>
                                                <div class="flex-grow-1 text-truncate">
                                                    <h4 class="m-0">{{ $value->property->title }} 
                                                        {{-- <span class="badge rounded text-blue bg-blue-subtle">{{ $value->property->savedProprty->count() }}</span> --}}
                                                    </h4>
                                                    {{ $value->property->area->name }}, {{ $value->property->city->name ?? '' }}<br />
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $roomsArray = json_decode($value->property->rooms, true) ?? [];
                                            @endphp
                                            @if(!empty($roomsArray))
                                                @foreach($roomsArray as $room)
                                                    <div class="room-item">
                                                        <span>{{ isset($room['title']) ? strtoupper(str_replace('_', ' ', $room['title'])) : '' }} </span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $roomsArray = json_decode($value->property->rooms, true) ?? [];

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
                                                    @if(!empty($room['price']))
                                                        <p class="m-0">₹{{ $formatPrice($room['price']) }}</p>
                                                    @endif                                            
                                                @endforeach
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <div class="user-avatar">
                                                @if ($value->property->builder && $value->property->builder->logo)
                                                        <img src="{{ asset('uploads/builder/' . $value->property->builder->logo) }}" height="80" width="80" class="rounded-circle" >
                                                    @else
                                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" 
                                                            alt="" height="80" class="me-2 align-self-center rounded" />
                                                    @endif

                                                    <div class="user-details">
                                                        <strong>{{ $value->property->builder->name }}</strong><br>
                                                        E: <a href="mailto:{{ $value->property->builder->email }}">{{ $value->property->builder->email }}</a><br>
                                                        M: <a href="tel:{{ $value->property->builder->mobile }}">{{ $value->property->builder->mobile }}</a>
                                                    </div>
                                            </div>                                    
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(Auth::id() === $value->property->user_id) 
                                                    @foreach($value->property->applications as $application)
                                                        @if($application->user_id !== $value->property->user_id) 
                                                            <div class="user-avatar" title="{{ $application->user->name }}">
                                                                @if (!empty($application->user->name))
                                                                    <img src="{{ asset('profile_pic/thumb/' . $application->user->image) }}" alt="{{ $application->user->name }}" class="rounded-circle">
                                                                @else
                                                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="me-2 align-self-center rounded"  />
                                                                @endif
                                                                
                                                                <div class="user-details">
                                                                    <strong>{{ $application->user->name }}</strong><br>
                                                                    {{-- {{ $application->user->role }}<br> --}}
                                                                    E: <a href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a><br>
                                                                    M: <a href="tel:{{ $application->user->mobile }}">{{ $application->user->mobile }}</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </td>                                
                                        <td>
                                            @if ($value->property->status == 1)
                                                <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @else
                                                <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @endif 
                                            <a href="#" onclick="removeProperty({{ $value->id }})"><i class="las la-trash-alt text-secondary fs-18"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr><td colspan="5">Property not found</td></tr>
                            @endif
                        @else
                            @if ($saved->isNotEmpty())
                                @foreach ($saved as $value)
                                <tr>
                                    <td class="px-0">
                                        <div class="d-flex align-items-center">
                                            @php
                                                $PropertyImage = $value->property->property_images->first();
                                            @endphp
                                            <a href="{{ route('propertyDetails', $value->property_id) }}" class="thumb">
                                                <span class="property-id">{{ $value->id }}</span>
                                                @if ($PropertyImage && !empty($PropertyImage->image))
                                                    <img src="{{ asset('uploads/property/small/' . $PropertyImage->image) }}"  height="100" width="100" class="me-2 align-self-center rounded" >
                                                @else
                                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" height="100" width="100" class="me-2 align-self-center rounded" >
                                                @endif
                                            </a>
                                            <div class="flex-grow-1 text-truncate">
                                                <h5 class="m-0">{{ $value->property->title }} <span class="badge rounded text-blue bg-blue-subtle">{{ $value->property->savedProprty->count() }}</span></h5>                                            
                                                {{ $value->property->area->name }}, {{ $value->property->city->name ?? '' }}<br />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $roomsArray = json_decode($value->property->rooms, true) ?? [];
                                        @endphp
                                        @if(!empty($roomsArray))
                                            @foreach($roomsArray as $room)
                                                <div class="room-item">
                                                    <span>{{ isset($room['title']) ? strtoupper(str_replace('_', ' ', $room['title'])) : '' }} </span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $roomsArray = json_decode($value->property->rooms, true) ?? [];

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
                                                @if(!empty($room['price']))
                                                    <p class="m-0">₹{{ $formatPrice($room['price']) }}</p>
                                                @endif                                            
                                            @endforeach
                                        @endif
                                    </td>                                    
                                    <td>
                                        <div class="user-avatar">
                                            @if ($value->property->builder && $value->property->builder->logo)
                                                    <img src="{{ asset('uploads/builder/' . $value->property->builder->logo) }}" height="80" width="80" class="rounded-circle" >
                                                @else
                                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" 
                                                        alt="" height="80" class="me-2 align-self-center rounded" />
                                                @endif

                                                <div class="user-details">
                                                    <strong>{{ $value->property->builder->name }}</strong><br>
                                                    E: <a href="mailto:{{ $value->property->builder->email }}">{{ $value->property->builder->email }}</a><br>
                                                    M: <a href="tel:{{ $value->property->builder->mobile }}">{{ $value->property->builder->mobile }}</a>
                                                </div>
                                        </div>                                    
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if(Auth::id() === $value->property->user_id) 
                                                @foreach($value->property->applications as $application)
                                                    @if($application->user_id !== $value->property->user_id) 
                                                        <div class="user-avatar" title="{{ $application->user->name }}">
                                                            @if (!empty($application->user->name))
                                                                <img src="{{ asset('profile_pic/thumb/' . $application->user->image) }}" alt="{{ $application->user->name }}" class="rounded-circle">
                                                            @else
                                                                <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="me-2 align-self-center rounded"  />
                                                            @endif
                                                            
                                                            <div class="user-details">
                                                                <strong>{{ $application->user->name }}</strong><br>
                                                                {{-- {{ $application->user->role }}<br> --}}
                                                                E: <a href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a><br>
                                                                M: <a href="tel:{{ $application->user->mobile }}">{{ $application->user->mobile }}</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>                                
                                    <td>                                        
                                        <a href="#" onclick="removeProperty({{ $value->id }})"><i class="las la-trash-alt text-secondary fs-18"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr><td colspan="5">Property not found</td></tr>
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $saved->links() }}
        </div>
    </div>
</div>
</section>
@endsection

@section('customJs')
<script type="text/javascript">
    function removeProperty(id){
        if(confirm("Are you sure you want to remove?")){
                $.ajax({
                url: '{{ route("account.removeSavedProperty") }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response){
                    window.location.href='{{ route("property.savedProperties") }}';
            }
            });
        }
    }
</script>
@endsection
