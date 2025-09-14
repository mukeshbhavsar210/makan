@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-12">
                <h1>Property <span class="counts">{{ $counts }}</span></h1>
            </div>
            <div class="col-sm-5 col-12">
                @if($properties->isNotEmpty())
                    <div class="search-top">
                        <form action="" method="get" class="part">
                            <div class="search-top">
                                <div class="input-group input-group" style="width: 250px;">
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control float-right" placeholder="Search properties...">                                    
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary icon-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>                                
                                <button type="button" onclick="window.location.href='{{ route('properties.index') }}'" class="btn icon-btn"><i class="fa-solid fa-arrow-rotate-right"></i></button>
                            </div>
                        </form>

                        <a href="{{ route('properties.create') }}" class="btn btn-primary part">New Property</a>
                    </div>
                @endif
            </div>
        </div>
   
        @include('front.layouts.message')

        @auth
            <div class="view-controls">
                <span class="view-label">Card</span>
                <label class="switch">
                    <input type="checkbox" class="toggle-view" data-id="{{ auth()->id() }}" {{ (auth()->user()->preferred_view ?? 'card') === 'table' ? 'checked' : '' }} >
                    <span class="slider round"></span>
                </label>
                <span class="view-label">Table</span>
            </div>
        @endauth

        @if(Auth::user()->role == 'Admin')
            <ul class="nav nav-tabs mt-3" id="propertyTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#approved">Approved {{ $approvedCount }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#pending">Pending {{ $pendingCount }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#expired">Expired {{ $expiredCount }}</a>
                </li>
            </ul>

            <div class="tab-content mt-2">
                <div class="tab-pane fade show active" id="approved">
                    <div class="row mt-2">                        
                        @foreach($properties as $property)
                            @if($property->verification == 'approved')
                                <x-card :data="$property" type="property" />
                            @endif
                        @endforeach
                        {{ $properties->links() }}
                    </div>
                </div>

                 <div class="tab-pane fade" id="pending">
                    <div class="row mt-2">
                        @foreach($pending as $property)
                            @if($property->verification == 'pending')
                                <x-card :data="$property" type="property" />
                            @endif
                        @endforeach
                        {{ $pending->links() }}                            
                    </div>
                </div>

                <div class="tab-pane fade" id="expired">
                    <div class="row mt-2">
                        @foreach($expired as $property)
                            @if($property->verification == 'expired')
                                <x-card :data="$property" type="property" />
                            @endif
                        @endforeach
                        {{ $expired->links() }}                   
                    </div>
                </div>
            </div>
        @else
            <div id="cardView" class="{{ $viewType === 'table' ? 'd-none' : '' }}">
                <div class="row mt-2">
                    @foreach($properties as $property)
                        <x-card :data="$property" type="property" />
                    @endforeach
                    {{ $properties->links() }}
                </div>
            </div>
            <div id="tableView" class="{{ $viewType === 'card' ? 'd-none' : '' }}">
                <div class="table-responsive browser_users">
                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr>
                                <th class="border-top-0">Photos</th>
                                <th class="border-top-0">Project Name</th>                    
                                <th class="border-top-0">Price</th>
                                @if(Auth::user()->role == 'Admin')
                                    <th class="border-top-0">Developer</th>
                                @endif
                                <th class="border-top-0">Interested</th>
                                <th class="border-top-0">Saved</th>
                                <th class="border-top-0">Posted</th>                            
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            @if($properties->isNotEmpty())
                                @foreach($properties as $property)
                                    <x-table :data="$property" type="property" />
                                @endforeach
                                {{ $properties->links() }}
                            <div class="mt-4">
                                
                            </div>                        
                            @else                
                                <h6>Not posted property yet.</h6>
                                <a href="{{ route('properties.create') }}" class="btn btn-primary">Post Property</a>                
                            @endif 
                        </tbody>
                    </table>
                </div>        
            </div>
        @endif
    </div>
</section>
@endsection

@section('customJs')
<script>
    $(document).on('change', '.toggle-status', function () {
        let propertyId = $(this).data('id');
        let isChecked = $(this).is(':checked'); // true if checked, false if unchecked

        // Simple alert
        if (isChecked) {
            alert("You have checked this property!");
        } else {
            alert("Are you sure you want to De-Active property?");
        }

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