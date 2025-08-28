@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1>Property <span class="badge rounded text-blue bg-blue-subtle">{{ $counts }}</span></h1>
            </div>
            <div class="col-sm-4">
                <form action="" method="get" >
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" onclick="window.location.href='{{ route('properties.index') }}'" class="btn btn-primary btn-sm">Reset</button>
                            <div class="input-group input-group" style="width: 250px;">
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="iconoir-search"></i>
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            <a href="{{ route('properties.create') }}" class="btn btn-primary pull-right">New Property</a>
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
                                    $PropertyImage = $value->property_images->first();
                                @endphp
                                <tr>
                                    <td class="px-0">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('propertyDetails', $value->id) }}" target="_blank">
                                                @if (!empty($PropertyImage->image))
                                                    <img src="{{ asset('uploads/property/small/'.$PropertyImage->image) }}" height="80" width="80" class="me-2 align-self-center rounded" >
                                                @else
                                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="me-2 align-self-center rounded"  />
                                                @endif
                                            </a>
                                            <div class="flex-grow-1 text-truncate"> 
                                                <h5 class="m-0">{{ $value->title }} <span class="badge rounded text-blue bg-blue-subtle">{{ $value->applications->count() }}</span></h5>
                                                {{ $value->builder->name ?? '' }}<br />
                                                <a href="{{ route('propertyDetails', $value->id) }}" target="_blank" class="font-12 mt-1 mb-1 text-muted text-decoration-underline">#{{ $value->id }}</a>
                                            </div>
                                        </div>
                                    </td>
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
                                            @foreach($value->applications as $application)
                                                <div class="user-avatar" title="{{ $application->user->name }}">
                                                    @if (!empty($application->user->image))
                                                        <img src="{{ asset('profile_pic/thumb/' . $application->user->image) }}" alt="{{ $application->user->name }}" class="rounded-circle">
                                                    @else
                                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="thumb-md shadow-sm rounded-circle"  />
                                                    @endif

                                                    <!-- Hover Card -->
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
                                    <td>{{ \Carbon\Carbon::parse($value->created_at)->format('M, Y') }}</td>                                        

                                    <td>
                                        @if ($value->status == 1)
                                            <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @else
                                            <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @endif                                    
                                    </td>
                                    <td>
                                        <a href="{{ route('properties.edit', $value->id) }}"><i class="las la-pen text-secondary fs-18"></i></a>
                                        <a href="#" onclick="deleteProperty( {{ $value->id }} )"><i class="las la-trash-alt text-secondary fs-18"></i></a>
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