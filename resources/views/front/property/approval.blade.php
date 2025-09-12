@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">           
        <div class="progress-right">
            <h4 class="mb-4">Approval on Property</h4>
            <nav>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Approved - {{ $approvedCount }}</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Pending - {{ $pendingCount }}</button>				
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Property</th>
                                <th>Name</th>
                                <th>Plan</th>
                                <th>Posted On</th>
                                <th>Expired On</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($approved as $property)
                            <tr>
                                <td style="width: 50px;">{{ $property->id }}</td>
                                <td style="width: 100px;">                                    
                                    <a target="_blank" href="{{ $property->url }}" onclick="visitedProperty({{ $property->id }})" class="product-link" target="_blank">
                                        @if ($property->property_images && $property->property_images->count())
                                            @foreach ($property->property_images->whereIn('label', ['Main',]) as $propertyImage)
                                                <img src="{{ asset('uploads/property/thumb/'.$propertyImage->image) }}" alt="{{ $propertyImage->label }}" height="100%" width="100%">
                                            @endforeach
                                        @else
                                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="Default" height="100%" width="100%">
                                        @endif                
                                    </a>                    
                                </td>
                                <td>
                                    <h5 class="m-0 mt-4">{{ $property->title }}</h5>
                                    <p class="m-0">{{ $property->user->name ?? 'N/A' }} ({{ $property->user->role ?? 'N/A' }})</p>
                                </td>
                                <td>{{ $property->plan ? $property->plan->name : 'No Plan Selected' }}</td>
                                <td style="width: 150px;">{{ \Carbon\Carbon::parse($property->start_date)->format('d M, Y') }}</td>
                                <td style="width: 150px;">{{ \Carbon\Carbon::parse($property->end_date)->format('d M, Y') }}</td>
                                <td style="width: 100px;">
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-status" data-id="{{ $property->id }}" {{ $property->status ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5">No approved properties</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $approved->links() }}
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Property</th>
                                <th>Name</th>
                                <th>Plan</th>
                                <th>Posted On</th>
                                <th>Expired On</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($pending as $property)
                            <tr>
                                <td style="width: 5px;">{{ $property->id }}</td>
                                <td style="width: 100px;">
                                    <a target="_blank" href="{{ $property->url }}" onclick="visitedProperty({{ $property->id }})" class="product-link" target="_blank">
                                        @if ($property->property_images && $property->property_images->count())
                                            @foreach ($property->property_images->whereIn('label', ['Main',]) as $propertyImage)
                                                <img src="{{ asset('uploads/property/thumb/'.$propertyImage->image) }}" alt="{{ $propertyImage->label }}" height="100%" width="100%">
                                            @endforeach
                                        @else
                                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="Default" height="100%" width="100%">
                                        @endif                
                                    </a>                    
                                </td>
                                <td>
                                    <h5 class="m-0 mt-4">{{ $property->title }}</h5>
                                    <p class="m-0">{{ $property->user->name ?? 'N/A' }} ({{ $property->user->role ?? 'N/A' }})</p>
                                </td>
                                <td>{{ $property->plan ? $property->plan->name : 'No Plan Selected' }}</td>
                                <td style="width: 150px;">{{ \Carbon\Carbon::parse($property->start_date)->format('d M, Y') }}</td>
                                <td style="width: 150px;">{{ \Carbon\Carbon::parse($property->end_date)->format('d M, Y') }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-status" data-id="{{ $property->id }}" {{ $property->status ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5">No pending properties</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $pending->links() }}
                </div>
            </div>                    
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
   $(document).on('change', '.toggle-status', function () {
        let propertyId = $(this).data('id');
        $.ajax({
            url: "{{ route('properties.toggleStatus', '') }}/" + propertyId,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                if(response.status){
                    console.log("Updated: " + response.newStatus);
                    location.reload();
                }
            },
            error: function(xhr){
                console.error("AJAX Error:", xhr.responseText);
            }
        });
    });
</script>
@endsection
