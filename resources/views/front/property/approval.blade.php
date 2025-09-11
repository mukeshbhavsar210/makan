@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">           
        <div class="progress-right">
            <h5>Properties</h5>
            <nav>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Approved</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Pending</button>				
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th><th>Title</th><th>Owner</th><th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($approved as $property)
                            <tr>
                                <td>{{ $property->id }}</td>
                                <td>{{ $property->title }}</td>
                                <td>{{ $property->user->name ?? 'N/A' }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-status" data-id="{{ $property->id }}" {{ $property->status ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No approved properties</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $approved->links() }}
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th><th>Title</th><th>Owner</th><th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($pending as $property)
                            <tr>
                                <td>{{ $property->id }}</td>
                                <td>{{ $property->title }}</td>
                                <td>{{ $property->user->name ?? 'N/A' }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-status" data-id="{{ $property->id }}" {{ $property->status ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No pending properties</td></tr>
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
