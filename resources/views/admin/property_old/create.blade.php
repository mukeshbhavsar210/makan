@extends('front.layouts.app')

@section('content')

    <section class="content-header">
        <div class="row">
            <div class="col-md-9 col-6">
                <h1>Create Property</h1>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('properties.index') }}" class="btn btn-primary pull-right">Back</a>            
            </div>
        </div>
    </section>    

        <form action="" method="post" id="createPropertyForm" name="createPropertyForm" >
            @csrf
            <div class="card">                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="progress-left">
                                <div class="card-body">
                                    <h5>Post your property</h5>
                                    <p>Sell or rent your property</p>
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#tab_01" role="tab" aria-controls="pills-home" aria-selected="true">
                                                <div class="status-details">
                                                    <p class="tick"></p>
                                                    <p class="title">Basic Details<br />
                                                        <span class="status">Completed</span>
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#tab_02" role="tab" aria-controls="pills-profile" aria-selected="false">
                                                <div class="status-details">
                                                    <p class="tick"></p>
                                                    <p class="title">Properties Details<br />
                                                        <span class="status">Completed</span>
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#tab_03" role="tab" aria-controls="pills-contact" aria-selected="false">
                                                <div class="status-details">
                                                    <p class="tick"></p>
                                                    <p class="title">Price Details<br />
                                                        <span class="status">Completed</span>
                                                        <span class="status">Pending</span>
                                                    </p>
                                                </div>                                                                                                
                                            </a>
                                        </li>
                                    </ul>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-12">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="tab_01" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="card border">
                                        <div class="card-body p-5">
                                            <h5 class="mb-4">Add Basic Details</h5>

                                            <p>Property Type</p>
                                            <ul class="nav nav-pills property-types" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Residential</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Commercial</a>
                                                </li>                                               
                                            </ul>

                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                    <h2>Home</h2>
                                                </div>

                                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                    <h2>Profile</h2>                                                
                                                </div>                                            
                                            </div>
                                                                                    
                                            <div class="form-group">
                                                <label for="category" class="mb-1">Looking to<span class="req">*</span></label><br />
                                                <div class="btn-group" role="group" aria-label="Is Category Switch">
                                                    <input type="radio" class="btn-check" name="category" id="is_category_buy" value="buy" autocomplete="off"
                                                        {{ (isset($property) && $property->category == 'buy') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                                    <label class="btn btn-outline-primary" for="is_category_buy">Buy</label>

                                                    <input type="radio" class="btn-check" name="category" id="is_category_rent" value="rent" autocomplete="off"
                                                        {{ (isset($property) && $property->category == 'rent') ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="is_category_rent">Rent</label>
                                                </div> 
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="mb-1">City<span class="req">*</span></label>
                                                        <select name="city" id="city" class="form-select">
                                                            <option value="">Select a City</option>
                                                            @if ($cities->isNotEmpty())
                                                                @foreach ($cities as $value)
                                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>                            
                                                    </div>
                                                </div>  
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="mb-1">Area<span class="req">*</span></label>
                                                        <select name="area" id="area" class="form-select">
                                                            <option value="">Select Area</option>
                                                        </select>                        
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="#" class="btn btn-primary w-100">Next, add property details</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab_02" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card border">
                                        <div class="card-body">
                                            <h5>Add Property Details</h5>

                                            <div class="form-group">
                                                <label for="property_types" id="propertyTypesCounts" class="mb-1">Property Type<span class="req">*</span></label>

                                                @php
                                                    $selectedType = isset($property) ? $property->property_types : '';
                                                @endphp

                                                <div class="d-flex flex-wrap gap-2">
                                                    <input type="radio" class="btn-check" name="property_types" id="type_apartment" value="apartment" {{ $selectedType == 'apartment' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="type_apartment">Apartment</label>

                                                    <input type="radio" class="btn-check" name="property_types" id="type_independent_house" value="independent_house" {{ $selectedType == 'independent_house' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="type_independent_house">Independent<br /> House</label>

                                                    <input type="radio" class="btn-check" name="property_types" id="type_independent_floor" value="independent_floor" {{ $selectedType == 'independent_floor' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="type_independent_floor">Independent<br /> Floor</label>

                                                    <input type="radio" class="btn-check" name="property_types" id="type_plot" value="plot" {{ $selectedType == 'plot' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="type_plot">Plot</label>

                                                    <input type="radio" class="btn-check" name="property_types" id="type_studio" value="studio" {{ $selectedType == 'studio' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="type_studio">Studio</label>

                                                    <input type="radio" class="btn-check" name="property_types" id="type_duplex" value="duplex" {{ $selectedType == 'duplex' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="type_duplex">Duplex</label>

                                                    <input type="radio" class="btn-check" name="property_types" id="type_pent_house" value="pent_house" {{ $selectedType == 'pent_house' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="type_pent_house">Pent<br /> House</label>

                                                    <input type="radio" class="btn-check" name="property_types" id="type_villa" value="villa" {{ $selectedType == 'villa' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="type_villa">Villa</label>

                                                    <input type="radio" class="btn-check" name="property_types" id="type_agricultural_land" value="agricultural_land" {{ $selectedType == 'agricultural_land' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="type_agricultural_land">Agricultural<br /> Land</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="title" class="mb-1">Property name<span class="req">*</span></label>
                                                <input type="text" placeholder="Building/Project/Society" id="title" name="title" class="form-control">
                                                <input type="text" readonly name="slug" id="slug" class="form-control d-none" placeholder="Slug">
                                                <p></p>
                                            </div> 

                                            <div class="form-group">
                                                <label for="location" class="mb-1">Property Location<span class="req">*</span></label>
                                                <input type="text" placeholder="Location" id="location" name="location" class="form-control">                            
                                            </div>

                                             <div class="form-group">
                                                <label for="room" id="roomCounts" class="mb-1">BHK, Price and Sq ft <span class="req">*</span></label>

                                                @php
                                                    $selectedRooms = isset($property) ? json_decode($property->rooms, true) ?? [] : [];
                                                    $selectedRoomTitles = array_column($selectedRooms, 'title');
                                                    $roomPrices = collect($selectedRooms)->mapWithKeys(fn($item) => [
                                                        $item['title'] => $item['price'] ?? ''
                                                    ])->toArray();
                                                    $roomSizes = collect($selectedRooms)->mapWithKeys(fn($item) => [
                                                        $item['title'] => $item['size'] ?? ''
                                                    ])->toArray();
                                                @endphp

                                                <div class="row">
                                                    @foreach (['1_rk'=>'1 RK','1_bhk'=>'1 BHK','2_bhk'=>'2 BHK','3_bhk'=>'3 BHK','4_bhk'=>'4 BHK','5_bhk'=>'5 BHK'] as $key => $label)
                                                        <div class="col-md-3">
                                                            <div class="card-bhk">
                                                                <!-- Checkbox -->
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input room-option" id="room_{{ $key }}" name="rooms[]" value="{{ $key }}"
                                                                        {{ in_array($key, $selectedRoomTitles) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="room_{{ $key }}">{{ $label }}</label>
                                                                </div>

                                                                <!-- Price input -->
                                                                <div class="flex-grow-1">
                                                                    <input type="text" class="form-control price showCheck"
                                                                        placeholder="Price"
                                                                        data-title="{{ $key }}"
                                                                        data-field="price"
                                                                        value="{{ $roomPrices[$key] ?? '' }}"
                                                                        {{ in_array($key, $selectedRoomTitles) ? '' : 'disabled' }}>
                                                                </div>

                                                                <!-- Size input -->
                                                                <div class="flex-grow-1">
                                                                    <input type="text" class="form-control size showCheck"
                                                                        placeholder="Sq Ft"
                                                                        data-title="{{ $key }}"
                                                                        data-field="size"
                                                                        value="{{ $roomSizes[$key] ?? '' }}"
                                                                        {{ in_array($key, $selectedRoomTitles) ? '' : 'disabled' }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <input type="hidden" name="rooms_json" id="rooms_json">
                                            </div>

                                                                            
                                            <div class="form-group">
                                                <label for="bathroom" id="bathroomCounts" class="mb-1">
                                                    Bathroom <span class="req">*</span>
                                                </label>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="bathroomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Select Bathroom
                                                    </button>

                                                    @php
                                                        // Handle old form values or default empty
                                                        $selectedBathrooms = old('bathrooms_json') ? json_decode(old('bathrooms_json'), true) : [];
                                                    @endphp

                                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="bathroomDropdown">
                                                        @foreach (['1_bath' => '1 Bath', '2_baths' => '2 Baths', '3_baths' => '3 Baths', '4_baths' => '4 Baths', '5_baths' => '5 Baths'] as $value => $label)
                                                            <li>
                                                                <label class="dropdown-item">
                                                                    <input type="checkbox" class="bathroom-option" value="{{ $value }}"
                                                                        {{ in_array($value, $selectedBathrooms) ? 'checked' : '' }}>
                                                                    {{ $label }}
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                {{-- Hidden field to hold JSON values --}}
                                                <input type="hidden" name="bathrooms_json" id="bathrooms_json" value="{{ old('bathrooms_json') }}">
                                            </div>

                                            <div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
<button id="btn" type="button"  class="btn btn-info btn-lg">Open Modal</button>
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Header</h4>
          <div class="d-flex justify-content-end">
      <button class="btn-close" aria_label="Close" data-bs-dismiss="modal" data-bs-title="Close window" data-bs-placement="right" data-bs-toggle="tooltip"></button>
    </div>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</div>
                
                                            <div class="form-group">
                                                <label id="amenitiesCounts">Amenities <span class="req">*</span></label>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="amenities-label" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Select Amenities
                                                    </button>

                                                    @php
                                                        // For create page, no amenities selected
                                                        $selectedAmenities = old('amenities_json') ? json_decode(old('amenities_json'), true) : [];
                                                    @endphp

                                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="amenities-label">
                                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="1" {{ in_array("1",$selectedAmenities) ? 'checked' : '' }}> Gated Community</label></li>
                                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="2" {{ in_array("2",$selectedAmenities) ? 'checked' : '' }}> Lift</label></li>
                                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="3" {{ in_array("3",$selectedAmenities) ? 'checked' : '' }}> Swimming Pool</label></li>
                                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="4" {{ in_array("4",$selectedAmenities) ? 'checked' : '' }}> Gym</label></li>
                                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="5" {{ in_array("5",$selectedAmenities) ? 'checked' : '' }}> Security</label></li>
                                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="6" {{ in_array("6",$selectedAmenities) ? 'checked' : '' }}> Parking</label></li>
                                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="7" {{ in_array("7",$selectedAmenities) ? 'checked' : '' }}> Gas Pipeline</label></li>
                                                    </ul>
                                                </div>
                                                <input type="hidden" name="amenities_json" id="amenities_json">
                                            </div>

                                            <a href="#" class="btn btn-primary">Next, add price details</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab_03" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    <h2>Contact</h2>
                                </div>
                            </div>

                            <div class="row">
                                
                               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="saletype" class="mb-1">Sale Type<span class="req">*</span></label>
                                        <div class="btn-group" role="group" aria-label="Is SaleType Switch">
                                            <input type="radio" class="btn-check" name="sale_types" id="is_sale_new" value="new" autocomplete="off"
                                                {{ (isset($property) && $property->sale_types == 'new') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                            <label class="btn btn-outline-primary" for="is_sale_new">New</label>

                                            <input type="radio" class="btn-check" name="sale_types" id="is_sale_resale" value="resale" autocomplete="off"
                                                {{ (isset($property) && $property->sale_types == 'resale') ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary" for="is_sale_resale">Resale</label>
                                        </div>                           
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    
                                    
                                    <div class="form-group">
                                        <label for="" class="mb-1">Description<span class="req">*</span></label>
                                        <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>                            
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="property_age" class="mb-1">Property Age<span class="req">*</span></label>
                                        <select name="property_age" id="property_age" class="form-select">
                                            <option value="">Select Property Age</option>
                                            <option value="1_year">Less than 1 year</option>
                                            <option value="3_years">Less than 3 years</option>
                                            <option value="5_years">Less than 5 years</option>
                                            <option value="6_years">More than 5 years</option>
                                        </select>
                                    </div>                                     
                                    <div class="form-group">
                                        <label for="total_area" class="mb-1">Total Area (in Sq.ft.)</label>
                                        <input type="text" placeholder="Total area" id="total_area" name="total_area" class="form-control">                            
                                    </div>
                                    <div class="form-group">
                                        <label for="property_age" class="mb-1">Tower</label>
                                        <input type="property_age" placeholder="Tower" id="towers" name="towers" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="property_age" class="mb-1">Units</label>
                                        <input type="property_age" placeholder="Units" id="units" name="units" class="form-control">
                                    </div>
                                </div>

                                <h4 class="mt-3">Builder details</h4>
                                <div class="col-md-8">
                                    <div class="form-group">   
                                        <label>Select Builder</label>   
                                        @if ($user->role === 'Admin' || $user->role === 'User')
                                            <select name="builder" id="builder" class="form-select">
                                                <option value="">Select a Developer</option>
                                                @forelse ($builders as $b)
                                                    <option value="{{ $b->id }}">{{ $b->developer_name }}</option>
                                                @empty
                                                    <option value="">No builders available</option>
                                                @endforelse
                                            </select>
                                        @elseif ($user->role === 'Builder' && $builder)
                                            <input type="text" class="form-control" value="{{ $builder->developer_name }}" readonly>
                                            <input type="hidden" name="builder" value="{{ $builder->id }}">
                                        @endif
                                    </div>   
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="year_build" class="mb-1">Year Build<span class="req">*</span></label>
                                        <div class="input-group date" id="year_build">
                                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="year_build" value="">
                                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <label id="similarCounts">Similar Properties <span class="req">*</span></label>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="similar-label" data-bs-toggle="dropdown" aria-expanded="false">
                                                Similar Properties
                                            </button>

                                            @php
                                                $selectedRelated = [];
                                            @endphp

                                            <ul class="dropdown-menu overflow-y w-100" aria-labelledby="similar-label">
                                                @if (!empty($relatedProperties))
                                                    @foreach ($relatedProperties as $value)
                                                        <li>
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" class="related_properties" value="{{ $value->id }}">
                                                                {{ $value->title }}
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        <input type="hidden" name="related_properties_json" id="related_properties_json">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="datepicker" class="mb-1">Handover Date<span class="req">*</span></label>
                                        <div class="input-group date" id="datepicker">
                                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="year_build">
                                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="" class="mb-1">Search Keywords</label>
                                        <input type="text" placeholder="Search keywords" id="keywords" name="keywords" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="rera" class="mb-1">RERA<span class="req">*</span></label>
                                        <input type="text" placeholder="RERA" id="rera" name="rera" class="form-control">                            
                                    </div>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label>Constructions Type?</label><br />
                                <div class="btn-group" role="group" aria-label="Is Construction Switch">
                                    <input type="radio" class="btn-check" name="construction_types" id="is_construction_under" value="under" autocomplete="off"
                                        {{ (isset($property) && $property->construction_types == 'under') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                    <label class="btn btn-outline-primary" for="is_construction_under">Under Construction</label>

                                    <input type="radio" class="btn-check" name="construction_types" id="is_construction_ready" value="ready" autocomplete="off"
                                        {{ (isset($property) && $property->construction_types == 'ready') ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="is_construction_ready">Ready to Move</label>
                                </div>
                                <p class="error"></p>
                            </div>

                           

                            <div class="form-group">
                                <label id="facingsCounts">Facings <span class="req">*</span></label>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="facings-label" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Facings
                                    </button>

                                    @php
                                        $selectedFacings = old('facings_json') ? json_decode(old('facings_json'), true) : [];
                                    @endphp

                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="facings-label">
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" class="facings" value="east" {{ in_array('east', $selectedFacings) ? 'checked' : '' }}> East
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" class="facings" value="west" {{ in_array('west', $selectedFacings) ? 'checked' : '' }}> West
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" class="facings" value="north" {{ in_array('north', $selectedFacings) ? 'checked' : '' }}> North
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" class="facings" value="south" {{ in_array('south', $selectedFacings) ? 'checked' : '' }}> South
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <input type="hidden" name="facings_json" id="facings_json">
                            </div>

                            <div class="row">                                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Show on page?</label><br />
                                        <div class="btn-group" role="group" aria-label="Is Featured Switch">
                                            <input type="radio" class="btn-check" name="is_featured" id="is_featured_yes" value="Yes" autocomplete="off"
                                                {{ (isset($property) && $property->is_featured == 'Yes') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                            <label class="btn btn-outline-primary" for="is_featured_yes">Yes</label>

                                            <input type="radio" class="btn-check" name="is_featured" id="is_featured_no" value="No" autocomplete="off"
                                                {{ (isset($property) && $property->is_featured == 'No') ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary" for="is_featured_no">No</label>
                                        </div>
                                        <p class="error"></p>
                                    </div>
                                </div>   
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label><br />
                                        <div class="btn-group" role="group" aria-label="Status Switch">
                                            <input type="radio" class="btn-check" name="status" id="status_active" value="1" autocomplete="off"
                                                {{ (isset($property) && $property->status == 1) ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                            <label class="btn btn-outline-primary" for="status_active">Active</label>

                                            <input type="radio" class="btn-check" name="status" id="status_block" value="0" autocomplete="off"
                                                {{ (isset($property) && $property->status == 0) ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary" for="status_block">Block</label>
                                        </div>
                                        <p class="error"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9">
                            <h4>Photos</h4>
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">
                                    <br>Drop files here or click to upload.<br><br>
                                </div>
                            </div>
                            <div class="row" id="product-gallery"></div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
                        
            <div class="card-footer">
                <div class="pull-right mb-3">
                    <a href="{{ route('properties.index') }}" class="btn m-1 btn-outline-dark">Cancel</a>
                    <button type="submit" id="createBtn" class="btn btn-primary m-1">Create</button>                         
                </div>
            </div>
        </div>
    </div>
</form>    
@endsection

@section('customJs')
<script>
    $(document).ready(function(){
        $("form").on("submit", function(){
            let btn = $("#createBtn");
            btn.prop("disabled", true);              // disable button
            btn.text("Updating Data...");            // change label
        });

        //Multiselect Checkbox
        function handleMultiSelect(optionsClass, dropdownId, labelId, hiddenInputId, defaultText) {
            $(optionsClass).on("change", function() {
                let selectedLabels = [];
                let selectedIds = [];

                $(optionsClass + ":checked").each(function() {
                    selectedLabels.push($(this).parent().text().trim());
                    selectedIds.push($(this).val());
                });

                // Update dropdown button text (first 2 labels + '...' if more)
                let displayText = "";
                if (selectedLabels.length > 2) {
                    displayText = selectedLabels.slice(0, 2).join(", ") + ", ...";
                } else if (selectedLabels.length > 0) {
                    displayText = selectedLabels.join(", ");
                } else {
                    displayText = defaultText;
                }
                $(dropdownId).text(displayText);

                // Update label with count
                $(labelId).text(selectedLabels.length ? defaultText.split(' ')[0] + " (" + selectedLabels.length + ")" : defaultText.split(' ')[0]);

                // Store selected IDs in hidden input
                $(hiddenInputId).val(selectedIds.join(","));
            });
        }

        // Apply to your selects
        handleMultiSelect(".room", "#room-label", "#roomCounts", "#room", "Select BHK");
        handleMultiSelect(".bathroom", "#bathroom-label", "#bathroomCounts", "#bathroom", "Select Bathroom");
        handleMultiSelect(".property-types", "#propertyTypes-label", "#propertyTypesCounts", "#property_types", "Select Property Types");
        handleMultiSelect(".amenities", "#amenities-label", "#amenitiesCounts", "#amenities", "Select Amenities");
        handleMultiSelect(".facings", "#facings-label", "#facingsCounts", "#facings", "Select Facings");
        handleMultiSelect(".similar", "#similar-label", "#similarCounts", "#similar", "Similar Properties");


        //Room json data
        function updateRoomsJson() {
            var data = [];
            var idCounter = 1;

            $('.room-option:checked').each(function() {
                var title = $(this).val();
                var price = $('.showCheck[data-title="' + title + '"]').val() || '';

                data.push({
                    id: idCounter,
                    title: title,
                    price: price
                });
                idCounter++;
            });

            $('#rooms_json').val(JSON.stringify(data));
        }

        $('.room-option').change(function() {
            var title = $(this).val();
            var input = $('.showCheck[data-title="' + title + '"]');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide().val('');
            }
            updateRoomsJson();
        });
        $('.showCheck').on('input', updateRoomsJson);
        // Initialize
        $('.room-option').each(function() {
            var input = $('.showCheck[data-title="' + $(this).val() + '"]');
            $(this).is(':checked') ? input.show() : input.hide();
        });
        updateRoomsJson();


        function bindJsonUpdater(checkboxClass, hiddenInputId) {
            function updateJson() {
                const data = $(`.${checkboxClass}:checked`).map(function () {
                    return $(this).val();
                }).get();
                $(`#${hiddenInputId}`).val(JSON.stringify(data));
            }

            $(document).on("change", `.${checkboxClass}`, updateJson);
            updateJson(); // initialize on page load
        }

        // Bind all
        bindJsonUpdater("bathroom-option", "bathrooms_json");
        bindJsonUpdater("property-types", "property_types_json");
        bindJsonUpdater("amenities", "amenities_json");
        bindJsonUpdater("facings", "facings_json");
        bindJsonUpdater("related_properties", "related_properties_json");
    });


    $("#city").change(function(){
        var city_id = $(this).val();
        $.ajax({
            url: '{{ route("areaSub.index") }}',            
            type: 'get',
            data: {city_id:city_id},
            dataType: 'json',
            success: function(response) {
                $("#area").find("option").not(":first").remove();
                $.each(response["subAreas"],function(key,item){
                    $("#area").append(`<option value='${item.id}' >${item.name}</option>`)
                })
            },
            error: function(){
                console.log("Something went wrong")
            }
        });
    })

   
    //Slug automatically add
    $('#title').change(function(){
        element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);
                if(response["status"] == true){
                    $("#slug").val(response["slug"]);
                }
            }
        });
    })

   //Product form add details in database
    $("#createPropertyForm").submit(function(event){
        event.preventDefault();

        var formArray = $(this).serializeArray();
        $("button[type='submit']").prop('disabled',true);

        $.ajax({
            url: '{{ route("properties.store") }}',
            type: 'post',
            data: formArray,
            dataType: 'json',
            success: function(response){

                $("button[type='submit']").prop('disabled',false);

                if (response['status'] == true) {

                    $(".error").removeClass('invalid-feedback').html('');
                    $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                    window.location.href="{{ route('properties.index') }}";

                } else {
                    var errors = response['errors'];

                    $(".error").removeClass('invalid-feedback').html('');
                    $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                    $.each(errors, function(key,value){
                        $(`#${key}`).addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(value);
                    });
                }
            },
            error: function(){
                console.log("Something went wrong")
            }
            // error: function(xhr, status, error){
            //     console.log("AJAX Error:", status, error);
            //     console.log("Response:", xhr.responseText);
            // }
        });
    });

    //File image uplaod
    Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url: "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                console.log(response);

                // Build HTML with label dropdown
                var html = `
                    <div class="col-md-3 mt-3" id="image-row-${response.image_id}">
                        <div class="media">
                            <input type="hidden" name="image_array[${response.image_id}][id]" value="${response.image_id}">
                            
                            <img src="${response.ImagePath}" class="img-fluid" />

                            <!-- Label selection -->
                            <select name="image_array[${response.image_id}][label]" class="form-control mt-2 image-label">
                                <option value="">Select Label</option>
                                <option value="Main">Main</option>
                                <option value="Video">Video</option>
                                <option value="Elevation">Elevation</option>
                                <option value="Bedroom">Bedroom</option>
                                <option value="Living">Living</option>
                                <option value="Balcony">Balcony</option>
                                <option value="Amenities">Amenities</option>
                                <option value="Floor">Floor</option>
                                <option value="Location">Location</option>
                                <option value="Cluster">Cluster</option>                        
                            </select>

                            <!-- Delete button -->
                            <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" 
                            class="deleteCardImg btn btn-sm btn-danger mt-2">X</a>
                        </div>
                    </div>`;

                $("#product-gallery").append(html);

                // Attach event after adding select
                $(".image-label").off("change").on("change", function() {
                    enforceUniqueLabels();
                });
            },
            complete: function(file) {
                this.removeFile(file);
            }
        });

        // Function to enforce unique labels
        function enforceUniqueLabels() {
            let selectedLabels = [];

            // Collect all selected labels
            $(".image-label").each(function() {
                let val = $(this).val();
                if (val) {
                    selectedLabels.push(val);
                }
            });

            // Reset all options first
            $(".image-label option").prop("disabled", false);

            // Disable already selected labels in other dropdowns
            $(".image-label").each(function() {
                let currentVal = $(this).val();
                selectedLabels.forEach(label => {
                    if (label !== currentVal) {
                        $(this).find("option[value='" + label + "']").prop("disabled", true);
                    }
                });
            });
        }
        //Delete image
        function deleteImage(id){
            $("#image-row-"+id).remove();
        }
</script>

@endsection