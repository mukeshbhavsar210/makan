@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-12">
                <h1>Property <span class="counts">{{ $counts }}</span></h1>
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
   
        @include('front.layouts.message')

        <div class="row mt-3">
            @if ($properties->isNotEmpty())                
                @foreach($properties as $value)
                    <div class="col-md-3 col-12">
                        @php
                            $PropertyImage = $value->property_images->where('label', 'Main')->first();
                            $totalImages = $value->property_images->count();
                        @endphp       
                        
                        <div class="listings-posted">   
                            <div class="link">   
                                <div class="overlay-details-top">
                                    @if( Auth::user()->role == 'Admin')
                                        <span class="tagSmall">{{ $value->id }}</span>
                                    @endif
                                    <span class="tagSmall">{{ $totalImages }}</span>
                                    <span class="tagSmall">{{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</span>
                                </div>
                                <div class="overlay-details-btm">
                                    <div>
                                        @if ($value->is_featured == 'Yes')
                                            <i class="fa-solid fa-circle-check tick-icon-active"></i>
                                        @else
                                            <i class="fa-solid fa-circle-check tick-icon"></i>
                                        @endif                                    
                                    </div>
                                    <div>
                                        <a href="{{ route('properties.edit', $value->id) }}"><i class="fa-solid fa-pencil"></i></a>
                                        <a href="#" onclick="deleteProperty( {{ $value->id }} )"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </div>

                                <a href="{{ $value->url }}"  target="_blank" class="overlay"></a>
                                                                         
                                @if (!empty($PropertyImage->image))
                                    <img src="{{ asset('uploads/property/thumb/'.$PropertyImage->image) }}" class="thumb" >
                                @else
                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt=""  class="thumb" />
                                @endif
                            </div>

                            <div class="details"> 
                                <h3 class="m-0">{{ $value->title }} 
                                    @if($value->visitedUsers->count())
                                        <span class="badge rounded text-blue bg-blue-subtle">{{ $value->visitedUsers->count() }}</span>    
                                    @endif
                                    <span class="badge rounded text-blue bg-blue-subtle"></span>
                                </h3>
                                <p class="m-0">{{ $value->location }}, {{ $value->area->name }}, {{ $value->city->name }}.</p>
                                
                                <hr />

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
                                                    $formatted = number_format($price / 100000, 1) . ' Lacs';
                                                } else {
                                                    $formatted = number_format($price);
                                                }
                                            @endphp                                        
                                        @endif                                                        
                                    @endforeach
                                @endif  

                                @if(!empty($roomsArray))
                                    @foreach($roomsArray as $room)                                                         
                                        {{ isset($room['title']) ? strtoupper(str_replace('_', ' ', $room['title'])) : '' }} - ₹{{ $formatted }} <span class="tint">{{ isset($room['size']) ? strtoupper(str_replace('_', ' ', $room['size'])) : '' }} sq.ft.</span><br />
                                    @endforeach
                                @endif        

                                
                                <div class="developer-details mt-3">
                                    <div class="logoFirst">
                                        @if ($value->builder && $value->builder->image)
                                            <img src="{{ asset('uploads/developer/thumb/' . $value->builder->image) }}" class="logo" >
                                        @else
                                            <img src="{{ asset('front-assets/images/default-150x150.png') }}" alt=""  class="logo" />
                                        @endif

                                        <div class="rollover-details">                                                                
                                            <p class="m-0"><b>{{ $value->builder->developer_name }}</b></p>
                                            <p class="m-0">E: <a href="mailto:{{ $value->builder->developer_email }}">{{ $value->builder->developer_email }}</a><br>
                                                M: <a href="tel:{{ $value->builder->developer_mobile }}">{{ $value->builder->developer_mobile }}</a>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-2">
                                        @if($value->applications->count() > 0)
                                        <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#propertyInterestedModal_{{ $value->id }}">Contacted: {{ $value->applications->count() > 0 ? $value->applications->count() : '' }}</a>

                                        <div class="modal fade bd-example-modal-lg" id="propertyInterestedModal_{{ $value->id }}" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content login-modal">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    <div class="modal-header">Contacted <span class="counts">{{ $value->applications->count() > 0 ? $value->applications->count() : '' }}</span></div>
                                                    <div class="modal-body">                                                        
                                                        <div class="user-listings">
                                                            @foreach($value->applications as $application)                                                                
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        @if (!empty($application->user->image))
                                                                            <img src="{{ asset('uploads/profile/thumb/' . $application->user->image) }}" alt="{{ $application->user->name }}" class="photo">
                                                                        @else
                                                                            <img src="{{ asset('front-assets/images/user.png') }}" alt="" class="photo" />
                                                                        @endif
                                                                    </div>

                                                                    <div class="col-md-10">
                                                                        <strong>{{ $application->user->name }}</strong><br>
                                                                        {{ $application->user->role }}<br>
                                                                        <a href="mailto:{{ $application->user->email }}">Email: {{ $application->user->email }}</a><br>
                                                                        <a href="tel:{{ $application->user->mobile }}">Mobile {{ $application->user->mobile }}</a>
                                                                    </div>
                                                                </div> <hr />                                                              
                                                            @endforeach        
                                                        </div>                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($value->savedUsers->count() > 0)
                                        <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#propertySavedModal_{{ $value->id }}">Saved: {{ $value->savedUsers->count() > 0 ? $value->savedUsers->count() : '' }}</a>

                                        <div class="modal fade bd-example-modal-lg" id="propertySavedModal_{{ $value->id }}" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content login-modal">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    <div class="modal-header">Saved <span class="counts">{{ $value->savedUsers->count() > 0 ? $value->savedUsers->count() : '' }}</span></div>
                                                    <div class="modal-body">
                                                        <div class="user-listings">
                                                            @foreach($value->savedUsers as $saved)
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
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                        Records not found
                    @endif 
                </div>
            </div>
        </div>
        <div class="clearfix">
            {{ $properties->links() }}
        </div>
    </div>
</div>

</section>
@endsection

@section('customJs')

<script>
    $(document).ready(function(){
        $(".logoFirst").hover(
            function() {
                $(this).find(".rollover-details").fadeIn(200);
            }, 
            function() {
                $(this).find(".rollover-details").fadeOut(200);
            }
        );
    });

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