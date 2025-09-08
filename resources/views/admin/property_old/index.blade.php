@extends('front.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-7 col-12">
                <h1>Property <span class="badge rounded text-blue bg-blue-subtle">{{ $counts }}</span></h1>
            </div>
            <div class="col-sm-5 col-12">
                <div class="search-top">
                    <form action="" method="get" class="part">
                        <div class="search-top">
                            <div class="input-group input-group" style="width: 250px;">
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary icon-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                            
                            <button type="button" onclick="window.location.href='{{ route('properties.index') }}'" class="btn icon-btn"><i class="fa-solid fa-arrow-rotate-right"></i></button>
                        </div>
                    </form>

                    <a href="{{ route('properties.create') }}" class="btn btn-primary part">New Property</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid">
    @include('admin.message')

    <div class="card">
        <div class="card-body table-responsive">
            <div class="table-responsive browser_users">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="border-top-0">Project Name</th>                            
                            <th class="border-top-0">BHK</th>
                            <th class="border-top-0">Price</th>
                            @if(Auth::user()->role == 'Admin')
                                <th class="border-top-0">Developer</th>
                            @endif
                            <th class="border-top-0">Interested</th>
                            <th class="border-top-0">Saved</th>
                            <th class="border-top-0">Posted</th>                            
                            <th class="border-top-0">Status</th>
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($properties->isNotEmpty())
                            @foreach($properties as $value)
                                @php
                                    $PropertyImage = $value->property_images->where('label', 'Main')->first();
                                    $totalImages = $value->property_images->count();
                                @endphp
                                <tr>
                                    <td class="px-0">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ $value->url }}" class="thumb" target="_blank">                                          
                                                @if( Auth::user()->role == 'Admin')
                                                    <span class="property-id">{{ $value->id }}</span>
                                                @endif

                                                <span class="total-images">{{ $totalImages }}</span>
                                                
                                                @if (!empty($PropertyImage->image))
                                                    <img src="{{ asset('uploads/property/thumb/'.$PropertyImage->image) }}" height="120" width="120" class="me-2 align-self-center rounded" >
                                                @else
                                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="120" class="me-2 align-self-center rounded"  />
                                                @endif                                                
                                            </a>
                                            <div class="flex-grow-1 text-truncate"> 
                                                <h4 class="m-0">{{ $value->title }} 
                                                    @if($value->visitedUsers->count())
                                                        <span class="badge rounded text-blue bg-blue-subtle">{{ $value->visitedUsers->count() }}</span>    
                                                    @endif
                                                    {{-- <span class="badge rounded text-blue bg-blue-subtle">{{ $value->applications->count() > 0 ? $value->applications->count() : '' }}</span> --}}
                                                </h4>
                                                <p class="m-0">{{ $value->location }}</p>
                                                <p class="m-0">{{ $value->area->name }}, {{ $value->city->name }}.</p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>                                        
                                        @php
                                            $roomsArray = json_decode($value->rooms, true) ?? [];
                                        @endphp

                                        @if(!empty($roomsArray))
                                            @foreach($roomsArray as $room)                                                         
                                                {{ isset($room['title']) ? strtoupper(str_replace('_', ' ', $room['title'])) : '' }} - {{ isset($room['size']) ? strtoupper(str_replace('_', ' ', $room['size'])) : '' }} sq.ft.<br />
                                            @endforeach
                                        @endif                                        
                                    </td>
                                    <td>                                        
                                        @php
                                            $roomsArray = json_decode($value->rooms, true) ?? [];
                                        @endphp

                                        @if(!empty($roomsArray))
                                            @foreach($roomsArray as $room)                                                                                                         
                                                @if(!empty($room['price']))
                                                    @php
                                                        $price = $room['price'];
                                                        if ($price >= 10000000) {
                                                            $formatted = number_format($price / 10000000, 1) . ' Cr';
                                                        } elseif ($price >= 100000) {
                                                            $formatted = number_format($price / 100000, 1) . ' L';
                                                        } else {
                                                            $formatted = number_format($price);
                                                        }
                                                    @endphp
                                                    <span class="price">₹{{ $formatted }}</span><br />
                                                @endif                                                        
                                            @endforeach
                                        @endif                                        
                                    </td>
                                    @if( Auth::user()->role == 'Admin')
                                        <td>
                                            <div class="user-avatar">
                                                @if ($value->builder && $value->builder->image)
                                                    <img src="{{ asset('uploads/builder/' . $value->builder->image) }}" height="80" width="80" class="rounded-circle" >                                                

                                                    <div class="user-details">
                                                        <strong>{{ $value->builder->developer_name }}</strong><br>                                                
                                                        E: <a href="mailto:{{ $value->builder->developer_email }}">{{ $value->builder->developer_email }}</a><br>
                                                        M: <a href="tel:{{ $value->builder->developer_mobile }}">{{ $value->builder->developer_mobile }}</a>
                                                    </div>
                                                @else
                                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" 
                                                        alt="" height="80" class="me-2 align-self-center rounded" />
                                                @endif
                                            </div>
                                        </td>           
                                    @endif                                        
                                    <td>
                                        <div class="d-flex">
                                            @foreach($value->applications as $application)
                                                <div class="img-group d-flex justify-content-end user-avatar" title="{{ $application->user->name }}">
                                                    <a class="position-relative d-inline-block" href="#">
                                                        @if (!empty($application->user->image))
                                                            <img src="{{ asset('profile_pic/thumb/' . $application->user->image) }}" alt="{{ $application->user->name }}" class="thumb-md shadow-sm rounded-circle">
                                                        @else
                                                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="thumb-md shadow-sm rounded-circle"  />
                                                        @endif
                                                    </a>                                                             
                                                    <div class="user-details">
                                                        <strong>{{ $application->user->name }}</strong><br>
                                                        {{ $application->user->role }}<br>
                                                        <a href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a><br>
                                                        <a href="tel:{{ $application->user->mobile }}">{{ $application->user->mobile }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>                                      
                                        <div class="d-flex">
                                            @foreach($value->savedUsers as $saved)
                                                <div class="img-group d-flex justify-content-end user-avatar" title="{{ $saved->user->name }}">
                                                    <a class="position-relative d-inline-block" href="#">
                                                        @if (!empty($saved->user->image))
                                                            <img src="{{ asset('profile_pic/thumb/' . $saved->user->image) }}" alt="{{ $saved->user->name }}" class="thumb-md shadow-sm rounded-circle">
                                                        @else
                                                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="thumb-md shadow-sm rounded-circle" />
                                                        @endif
                                                    </a>                                                             
                                                    <div class="user-details">
                                                        <strong>{{ $saved->user->name }}</strong><br>
                                                        {{ $saved->user->role }}<br>
                                                        <a href="mailto:{{ $saved->user->email }}">{{ $saved->user->email }}</a><br>
                                                        <a href="tel:{{ $saved->user->mobile }}">{{ $saved->user->mobile }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($value->created_at)->format('M, Y') }}</td>                                                                          
                                    <td>
                                        @if ($value->is_featured == 'Yes')
                                            <i class="fa-solid fa-circle-check tick-icon-active"></i>
                                        @else
                                            <i class="fa-solid fa-circle-check tick-icon"></i>
                                        @endif
                                    </td>
                                    <td>                                         
                                        <a href="{{ route('properties.edit', $value->id) }}"><i class="fa-solid fa-pencil"></i></a>
                                        <a href="#" onclick="deleteProperty( {{ $value->id }} )"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td>Records not found</td>
                                </tr>
                            @endif                         
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $properties->links() }}
        </div>
    </div>
</div>
@endsection

@section('customJs')

<script>
    function deleteProperty(id){
        var url = '{{ route("properties.delete","ID") }}'
        var newUrl = url.replace("ID",id)

        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                success: function(response){
                    if(response["status"]){
                        window.location.href="{{ route('properties.index') }}"
                    } else {
                        window.location.href="{{ route('properties.index') }}"
                    }
                }
            });
        }
    }
</script>
@endsection