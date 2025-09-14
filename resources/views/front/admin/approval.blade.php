@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">                   
        <h4 class="mb-4">Approval on Property</h4>
        <nav>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-approved-tab" data-bs-toggle="tab" data-bs-target="#nav-approved" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Approved - {{ $approvedCount }}</button>
                <button class="nav-link" id="nav-pending-tab" data-bs-toggle="tab" data-bs-target="#nav-pending" type="button" role="tab" aria-controls="nav-pending" aria-selected="false">Pending - {{ $pendingCount }}</button>
                <button class="nav-link" id="nav-expired-tab" data-bs-toggle="tab" data-bs-target="#nav-expired" type="button" role="tab" aria-controls="nav-expired" aria-selected="false">Expired - {{ $expiredCount }}</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade active show" id="nav-approved" role="tabpanel" aria-labelledby="nav-approved-tab">
                <table class="table table-striped border table-hover">
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
                            <td style="width: 80px;"> 
                                @php
                                    $PropertyImage = $property?->images?->first();
                                @endphp

                                <a target="_blank" href="{{ $property->property->url ?? '#' }}" onclick="visitedProperty({{ $property->id }})" class="product-link">
                                    @if (!empty($PropertyImage?->image))
                                        <img src="{{ asset('uploads/property/thumb/'.$PropertyImage->image) }}" height="80" width="80" class="me-2 align-self-center rounded">
                                    @else
                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="me-2 align-self-center rounded">
                                    @endif
                                </a>
                            </td>
                            <td>
                                <h5 class="m-0">{{ $property->title }}</h5>
                                <p class="m-0">{{ $property->user->name ?? 'N/A' }} ({{ $property->user->role ?? 'N/A' }})</p>
                            </td>
                            <td>{{ $property->plan ? $property->plan->name : 'No Plan Selected' }}</td>
                            <td style="width: 150px;">{{ \Carbon\Carbon::parse($property->start_date)->format('d M, Y') }}</td>
                            <td style="width: 150px;">{{ \Carbon\Carbon::parse($property->end_date)->format('d M, Y') }}</td>
                            <td style="width: 100px;">
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="{{ $property->id }}" {{ $property->verification === 'approved' ? 'checked' : '' }}>
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

            <div class="tab-pane fade" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                <label class="switch">
                    <input type="checkbox" id="toggle-all-pending">
                    <span class="slider round"></span>
                </label>

                <table class="table table-striped border table-hover">
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
                            <td style="width: 50px;">{{ $property->id }}</td>
                            <td style="width: 80px;">
                                @php
                                    $PropertyImage = $property?->images?->first();
                                @endphp

                                <a target="_blank" href="{{ $property->property->url ?? '#' }}" onclick="visitedProperty({{ $property->id }})" class="product-link">
                                    @if (!empty($PropertyImage?->image))
                                        <img src="{{ asset('uploads/property/thumb/'.$PropertyImage->image) }}" height="80" width="80" class="me-2 align-self-center rounded">
                                    @else
                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="me-2 align-self-center rounded">
                                    @endif
                                </a>              
                            </td>
                            <td>
                                <h5 class="m-0">{{ $property->title }}</h5>
                                <p class="m-0">{{ $property->user->name ?? 'N/A' }} ({{ $property->user->role ?? 'N/A' }})</p>
                            </td>
                            <td>{{ $property->plan ? $property->plan->name : 'No Plan Selected' }}</td>
                            <td style="width: 150px;">{{ \Carbon\Carbon::parse($property->start_date)->format('d M, Y') }}</td>
                            <td style="width: 150px;">{{ \Carbon\Carbon::parse($property->end_date)->format('d M, Y') }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="{{ $property->id }}" {{ $property->verification === 'approved' ? 'checked' : '' }}>
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

            <div class="tab-pane fade" id="nav-expired" role="tabpanel" aria-labelledby="nav-expired-tab">
                <table class="table table-striped border table-hover">
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
                    @forelse($expired as $property)
                        <tr>
                            <td style="width: 50px;">{{ $property->id }}</td>
                            <td style="width: 80px;">
                                @php
                                    $PropertyImage = $property?->images?->first();
                                @endphp

                                <a target="_blank" href="{{ $property->property->url ?? '#' }}" onclick="visitedProperty({{ $property->id }})" class="product-link">
                                    @if (!empty($PropertyImage?->image))
                                        <img src="{{ asset('uploads/property/thumb/'.$PropertyImage->image) }}" height="80" width="80" class="me-2 align-self-center rounded">
                                    @else
                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="me-2 align-self-center rounded">
                                    @endif
                                </a>              
                            </td>
                            <td>
                                <h5 class="m-0">{{ $property->title }}</h5>
                                <p class="m-0">{{ $property->user->name ?? 'N/A' }} ({{ $property->user->role ?? 'N/A' }})</p>
                            </td>
                            <td>{{ $property->plan ? $property->plan->name : 'No Plan Selected' }}</td>
                            <td style="width: 150px;">{{ \Carbon\Carbon::parse($property->start_date)->format('d M, Y') }}</td>
                            <td style="width: 150px;">{{ \Carbon\Carbon::parse($property->end_date)->format('d M, Y') }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="{{ $property->id }}" {{ $property->verification === 'approved' ? 'checked' : '' }}>
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


    $(document).on('change', '#toggle-all-pending', function () {
        let isChecked = $(this).is(':checked');

        // if(!confirm("Are you sure you want to approve all pending properties?")) {
        //     $(this).prop('checked', !isChecked);
        //     return;
        // }

        $.ajax({
            url: "{{ route('properties.bulkApprovePending') }}", // New route
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                approve: isChecked ? 1 : 0
            },
            success: function(response) {
                if(response.status){
                    location.reload(); // Refresh table to reflect changes
                }
            },
            error: function(xhr){
                console.error("AJAX Error:", xhr.responseText);
                alert("Something went wrong while updating properties.");
                $('#toggle-all-pending').prop('checked', !isChecked);
            }
        });
    });

</script>
@endsection
