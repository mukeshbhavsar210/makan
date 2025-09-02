@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Interested <span class="badge rounded text-blue bg-blue-subtle">{{ $counts }}</span></h1>
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
                        
                        <button type="button" onclick="window.location.href='{{ route('account.myPropertyApplications') }}'" class="btn icon-btn"><i class="las la-undo-alt"></i></button>
                    </div>
                </form>
            </div>               
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        @include('admin.layouts.message')

        <div class="card">
            <div class="card-body table-responsive">
                <div class="table-responsive browser_users">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-top-0">Property Name</th>
                                <th class="border-top-0">BHK</th>
                                <th class="border-top-0">Price</th>
                                <th class="border-top-0">Developer</th>
                                <th class="border-top-0">Interested</th>
                                <th class="border-top-0">Saved Date</th> 
                                <th class="border-top-0">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($interested->isNotEmpty())
                                    @foreach ($interested as $value)
                                    <tr>
                                        <td class="px-0">
                                            <div class="d-flex align-items-center">
                                                @php
                                                    $PropertyImage = $value->property->property_images->first();
                                                @endphp

                                                <a href="{{ route('property.dDetails', $value->property_id) }}" class="thumb" target="_blank">
                                                    @if(Auth::user()->role == 'Admin')
                                                        <span class="property-id">{{ $value->id }}</span>
                                                    @endif
                                                    @if ($PropertyImage && !empty($PropertyImage->image))
                                                        <img src="{{ asset('uploads/property/small/' . $PropertyImage->image) }}" height="100" width="100" class="me-2 align-self-center rounded" >                                                
                                                    @else
                                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="100" class="me-2 align-self-center rounded"  />
                                                    @endif
                                                </a>
                                                <div class="flex-grow-1 text-truncate"> 
                                                    <h4 class="m-0">{{ $value->property->title }} <span class="badge rounded text-blue bg-blue-subtle">{{ $value->property->applications->count() }}</span></h4>
                                                    <p class="m-0">{{ $value->property->locatiom }}</p>
                                                    <p class="m-0">{{ $value->property->area->name }}, {{ $value->property->city->name ?? '' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $roomsArray = json_decode($value->property->rooms, true) ?? [];
                                            @endphp
                                            @if(!empty($roomsArray))
                                                @foreach($roomsArray as $room)                                            
                                                    @if(!empty($room['price']))
                                                        <span>{{ isset($room['title']) ? strtoupper(str_replace('_', ' ', $room['title'])) : '' }} </span><br />
                                                    @endif                                            
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
                                                        <span>₹{{ $formatPrice($room['price']) }}</span><br />
                                                    @endif                                            
                                                @endforeach
                                            @endif                                                    
                                        </td>
                                        <td>
                                        <div class="user-avatar">
                                            @if ($value->property->builder && $value->property->builder->image)
                                                <img src="{{ asset('uploads/builder/' . $value->property->builder->image) }}" 
                                                    height="80" width="80" class="rounded-circle" >
                                                {{ $value->property->builder->developer_name }}
                                            @else
                                                <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="me-2 align-self-center rounded" />
                                            @endif
                                        </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @foreach($value->property->applications as $application)
                                                    <div class="user-avatar" title="{{ $application->user->name }}">
                                                        @if ($application->user->image)
                                                            <img src="{{ asset('profile_pic/thumb/' . $application->user->image) }}" alt="{{ $application->user->name }}" class="rounded-circle">
                                                        @else
                                                            <img src="{{ asset('admin-assets/img/user.png') }}" alt="" height="80" class="rounded-circle"  />
                                                        @endif
                                                        
                                                        <!-- Hover Card -->
                                                        <div class="user-details">
                                                            <strong>{{ $application->user->name }}</strong><br>
                                                            {{-- {{ $application->user->role }}<br> --}}
                                                            E: <a href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a><br>
                                                            M: <a href="tel:{{ $application->user->mobile }}">{{ $application->user->mobile }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M Y') }}</td>                                    
                                        <td>
                                            <a href="#" onclick="removeProperty({{ $value->id }})"><i class="las la-trash-alt text-secondary fs-18"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">people not found</td>
                                        </tr>
                                @endif 
                        </tbody>
                    </table>
                </div>

                {{ $interested->links() }}
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
                url: '{{ route("account.removeProperties") }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response){
                    window.location.href='{{ route("account.myPropertyApplications") }}';
            }
            });
        }
    }
</script>
@endsection
