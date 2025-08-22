@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Interested <span class="badge rounded text-blue bg-blue-subtle">{{ $counts }}</span></h1>
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
                                <th class="border-top-0">Counts</th>
                                <th class="border-top-0">Interested</th>
                                <th class="border-top-0">Saved Date</th>                                
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Action</th>
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

                                            <a href="{{ route('propertyDetails', $value->property_id) }}">
                                                @if ($PropertyImage && !empty($PropertyImage->image))
                                                    <img src="{{ asset('uploads/property/small/' . $PropertyImage->image) }}" height="80" width="80" class="me-2 align-self-center rounded" >                                                
                                                @else
                                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="me-2 align-self-center rounded"  />
                                                @endif
                                            </a>
                                            <div class="flex-grow-1 text-truncate"> 
                                                <h5 class="m-0">{{ $value->property->title }}</h5>
                                                <a href="{{ route('propertyDetails', $value->id) }}" target="_blank" class="font-12 mt-1 mb-1 text-muted text-decoration-underline">#{{ $value->id }}</a><br />
                                                {{ $value->property->location }}, {{ $value->property->city->name ?? '' }}
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $value->property->applications->count() }} </td>
                                    <td>
                                         <div class="d-flex align-items-center">
                                            @foreach($value->property->applications as $application)
                                                <div class="user-avatar" title="{{ $application->user->name }}">
                                                    <img src="{{ asset('profile_pic/thumb/' . $application->user->image) }}" 
                                                        alt="{{ $application->user->name }}" 
                                                        class="rounded-circle">

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
                                    <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M Y') }}</td>
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
                                    </td>
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
