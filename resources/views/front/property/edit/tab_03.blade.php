<div data-step="3">

<h5>Add Developer Details</h5>

<div class="row">
    <div class="col-md-9">
        <div class="form-group form-section">
            <label for="" class="light-label">Description<span class="req">*</span></label>
            <textarea class="form-control required-field" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $property->description}}</textarea>                            
        </div>

        <div class="form-group form-section">
            <label for="" class="light-label">Developer<span class="req">*</span></label>
            @if ($user->role === 'Admin' || $user->role === 'User' || $user->role === 'Agent')
                <select name="builder" id="builder" class="form-select required-field">
                    <option value="">Select a Developer</option>
                    @forelse ($builders as $b)
                        <option value="{{ $b->id }}"
                            {{ old('builder', $property->builder_id) == $b->id ? 'selected' : '' }}>
                            {{ $b->developer_name }}
                        </option>
                    @empty
                        <option value="">No builders available</option>
                    @endforelse
                </select>
            @elseif ($user->role === 'Builder' && $builder)
                <input type="text" class="form-control required-field" value="{{ $builder->developer_name }}" readonly>
                <input type="hidden" name="builder" value="{{ $builder->id }}">
            @endif
        </div>

        <div class="form-group form-section">
            <label for="rera" class="light-label">RERA<span class="req">*</span></label>
            <input type="text" value="{{ $property->rera}}" id="rera" name="rera" class="form-control required-field">                            
        </div> 
       
        <div class="form-group form-section">
            <label class="light-label">Construction Type <span class="req">*</span></label> <br />                                  
            <div class="custom-radio required-group">
                <input type="radio" class="btn-check" name="construction_types" id="construction_under" value="under" autocomplete="off"
                    {{ isset($property) && $property->construction_types == 'under' ? 'checked' : '' }}>
                <label class="btn-radio" for="construction_under">Under Construction</label>
                <input type="radio" class="btn-check" name="construction_types" id="construction_ready" value="ready" autocomplete="off"
                    {{ isset($property) && $property->construction_types == 'ready' ? 'checked' : '' }}>
                <label class="btn-radio" for="construction_ready">Ready to Move</label>
            </div>
            <p class="error"></p>
        </div>

        {{-- <div class="form-group">
            <label for="property_age" class="light-label">Property Age<span class="req">*</span></label>
            <select name="property_age" id="property_age" class="form-select">
                <option value="">Select Property Age</option>
                <option value="1_year" {{ (isset($property) && $property->property_age == '1_year') ? 'selected' : '' }}>Less than 1 year</option>
                <option value="3_years" {{ (isset($property) && $property->property_age == '3_years') ? 'selected' : '' }}>Less than 3 years</option>
                <option value="5_years" {{ (isset($property) && $property->property_age == '5_years') ? 'selected' : '' }}>Less than 5 years</option>
                <option value="6_years" {{ (isset($property) && $property->property_age == '6_years') ? 'selected' : '' }}>More than 5 years</option>
            </select>
        </div>  --}}

        <div class="form-group form-section">
            @php
                $ageOptions = [
                    '1_year' => '1 year',
                    '3_years' => '3 years',
                    '5_years' => '5 years',
                    '6_years' => 'More than 5 year',
                ];
            @endphp

            <label class="light-label">Property Age?</label><br />
            <div class="custom-radio required-group">
                @foreach ($ageOptions as $value => $label)
                    @php
                        $id = 'age_' . $loop->index;
                        $isChecked = isset($property) && $property->property_age == $value;
                        if (!isset($property) && $value === '1_year') {
                            $isChecked = true;
                        }
                    @endphp

                    <input type="radio" class="btn-check required-field" name="property_age" id="{{ $id }}" value="{{ $value }}" 
                        autocomplete="off" {{ $isChecked ? 'checked' : '' }}>

                    <label class="btn-radio" for="{{ $id }}">{{ $label }}</label>
                @endforeach
            </div>
            <p class="error"></p>
        </div>

        <div class="form-group some-div form-section">
            <label class="light-label">Facings - <span id="facingsCounts"></span></label>
            <div class="custom-checkbox-group">
                @php
                    $facings = ['east' => 'East', 'west' => 'West', 'north' => 'North', 'south' => 'South', 'south' => 'South', 'south' => 'South', 'south' => 'South', 'south' => 'South'];
                    $selectedFacings = old('facings_json') ? json_decode(old('facings_json'), true) : [];
                    if (empty($selectedFacings)) {
                        $selectedFacings[] = array_key_first($facings);
                    }
                @endphp

                <div class="custom-checkbox-group required-group">
                    @foreach ($facings as $value => $label)
                        <label class="custom-checkbox">
                            <input type="checkbox" class="facings" value="{{ $value }}" {{ in_array($value, $selectedFacings) ? 'checked' : '' }}>
                            <span class="btn-checkbox">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="facings_json" id="facings_json">
        </div>

        <a class="basic-link" href="#" data-bs-toggle="modal" data-bs-target="#similarModal">+ Add Similar Properties
            @php
                $selectedProperties = json_decode($property->related_properties, true) ?? [];
                $Count = count($selectedProperties);
            @endphp

            @if($Count > 0)
                ({{ $Count }})
            @endif
        </a>
        <div class="modal fade bd-example-modal-lg" id="similarModal" tabindex="-1" aria-labelledby="similarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content login-modal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-header">Add Similar Properties</div>
                    <div class="modal-body">
                        <div class="form-group">                            
                            @php
                                $selectedRelated = json_decode($property->related_properties, true) ?? [];
                            @endphp
                            
                            @if (!empty($relatedProperties))
                                <div class="custom-checkbox-group">
                                    @foreach ($relatedProperties as $value)                                    
                                        <label class="custom-checkbox">
                                            <input type="checkbox" class="related_properties" value="{{ $value->id }}"
                                                {{ in_array($value->id, $selectedRelated) ? 'checked' : '' }}>
                                            <span class="btn-checkbox">{{ $value->title }}</span>                                            
                                        </label>                                        
                                    @endforeach
                                </div>
                            @endif
                            
                            <input type="hidden" name="related_properties_json" id="related_properties_json">
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group form-section">
            <label for="year_build" class="light-label">Year Build<span class="req">*</span></label>
            <div class="input-group date" id="year_build">
                <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="year_build" value="{{ $property->year_build}}">
                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
            </div>
        </div>
        <div class="form-group form-section">
            <label for="datepicker" class="light-label">Handover Date<span class="req">*</span></label>
            <div class="input-group date" id="datepicker">
                <input type="text" class="form-control required-field" placeholder="YYYY-MM-DD" name="year_build" value="{{ $property->possession_date}}">
                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
            </div>
        </div>
        <div class="form-group form-section">
            <label for="towers" class="light-label">Tower</label>
            <input type="text" value="{{ $property->towers}}" id="towers" name="towers" class="form-control required-field">                                        
            <p></p>
        </div>
        <div class="form-group form-section">
            <label for="units" class="light-label">Units</label>
            <input type="text" value="{{ $property->units}}" id="units" name="units" class="form-control required-field">                                        
            <p></p>
        </div>
         <div class="form-group form-section">
            <label for="total_area" class="light-label">Total Area (in Sq.ft.)<span class="req">*</span></label>
            <input type="text" value="{{ $property->total_area}}" id="total_area" name="total_area" class="form-control required-field">                            
        </div>
        <div class="form-group form-section">
            <label>Brokerage?</label><br />
            <div class="custom-radio required-group">
                <input type="radio" class="btn-check" name="brokerage" id="brokerage_yes" value="1" autocomplete="off"
                    {{ isset($property) && $property->brokerage == 1 ? 'checked' : '' }}>
                <label class="btn-radio" for="brokerage_yes">Yes</label>

                <input type="radio" class="btn-check" name="brokerage" id="brokerage_no" value="0" autocomplete="off"
                    {{ isset($property) && $property->brokerage == 0 ? 'checked' : '' }}>
                <label class="btn-radio" for="brokerage_no">No</label>
            </div>
            <p class="error"></p>
        </div>
    </div>
</div>

<div id="image" class="dropzone dz-clickable mb-4">
    <div class="dz-message needsclick">
        <br>Drop files here or click to upload.<br><br>
    </div>
</div>

<a class="basic-link" href="#" data-bs-toggle="modal" data-bs-target="#uploadedPhotosModal">Uploaded Photos 
    @php
        $imageCount = $propertyImage->count();
    @endphp
    @if ($imageCount > 0)
        ({{ $imageCount }})
    @endif
</a>
    <div class="modal fade bd-example-modal-lg" id="uploadedPhotosModal" tabindex="-1" aria-labelledby="uploadedPhotosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content login-modal">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">Uploaded Photos 
                    @php
                        $imageCount = $propertyImage->count();
                    @endphp
                    @if ($imageCount > 0)
                        <span class="badge rounded text-blue bg-blue-subtle">{{ $imageCount }}</span>
                    @endif
                </div>
                <div class="modal-body">
                    <div id="product-gallery">
                        @if ($propertyImage->isNotEmpty())
                            @php
                                $usedLabels = $propertyImage->pluck('label')->filter()->toArray(); 
                                $labelOptions = [
                                    'Main'      => 1,
                                    'Video'     => 2,
                                    'Elevation' => 3,
                                    'Bedroom'   => 4,
                                    'Living'    => 5,
                                    'Balcony'   => 6,
                                    'Amenities' => 7,
                                    'Floor'     => 8,
                                    'Location'  => 9,
                                    'Cluster'   => 10,
                                ];

                                // Sort images by label mapping (default large number if no label)
                                $sortedImages = $propertyImage->sortBy(function ($img) use ($labelOptions) {
                                    return $labelOptions[$img->label] ?? 999; // unlabeled go to end
                                });
                            @endphp

                            <div class="row">
                                @foreach ($sortedImages as $image)
                                    <div class="media col-md-3" id="image-row-{{ $image->id }}">
                                        <input type="hidden" name="image_array[]" value="{{ $image->id }}">

                                        <img src="{{ asset('uploads/property/thumb/'.$image->image) }}" class="thumb" />
                                        
                                        <div class="overlay">
                                            <div class="field">
                                                @if ($image->label && isset($labelOptions[$image->label]))
                                                    <span class="order">{{ $labelOptions[$image->label] }}</span>
                                                @endif
                                                <select name="image_array[{{ $image->id }}][label]" class="form-select">
                                                <option value="">Select Label</option>
                                                    @foreach ($labelOptions as $option => $order)
                                                        <option value="{{ $option }}"
                                                            {{ $image->label == $option ? 'selected' : '' }}
                                                            {{ in_array($option, $usedLabels) && $image->label !== $option ? 'disabled' : '' }}>
                                                            {{ $option }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <a href="javascript:void(0)" onclick="deleteImage({{ $image->id }})" class="deleteCardImg">X</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" id="updateBtn" class="btn btn-primary big-btn">Update</button>
