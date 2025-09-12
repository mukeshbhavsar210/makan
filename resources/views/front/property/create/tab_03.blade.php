<div data-step="3">
<h5>Add Developer Details</h5>

    <div class="row">
        <div class="col-md-9">
            <div class="form-group form-section">
                <label for="" class="light-label">Description<span class="req">*</span></label>
                <textarea class="form-control required-field" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>                            
            </div>

            <div class="form-group form-section">   
                <label class="light-label">Select Builder</label>   
                @if ($user->role === 'Admin' || $user->role === 'User' || $user->role === 'Agent')
                    <select name="builder" id="builder" class="form-select required-field">
                        <option value="">Select a Developer</option>
                        @forelse ($builders as $b)
                            <option value="{{ $b->id }}">{{ $b->developer_name }}</option>
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
                <input type="text" placeholder="RERA" id="rera" name="rera" class="form-control required-field">                            
            </div>  

            <div class="form-group form-section">
                @php
                    $constructionOptions = [
                        'under' => 'Under Construction',
                        'ready' => 'Ready to Move',
                    ];
                @endphp

                <label class="light-label">Construction Type?</label><br />
                    <div class="custom-radio required-group">
                        @foreach ($constructionOptions as $value => $label)
                        @php
                            $id = 'construction_' . $loop->index;
                            $isChecked = isset($property) && $property->construction_types == $value;
                            if (!isset($property) && $value === 'under') {
                                $isChecked = true;
                            }
                        @endphp

                        <input type="radio" class="btn-check required-field" name="construction_types" id="{{ $id }}" value="{{ $value }}" 
                            autocomplete="off" {{ $isChecked ? 'checked' : '' }}>

                        <label class="btn-radio" for="{{ $id }}">{{ $label }}</label>
                    @endforeach
                </div>
                <p class="error"></p>
            </div>

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
    </div>

    <div class="col-md-3">
        <div class="form-group form-section">
            <label for="year_build" class="light-label">Year Build<span class="req">*</span></label>
            <div class="input-group date" id="year_build">
                <input type="text" class="form-control required-field" placeholder="YYYY-MM-DD" name="year_build" value="">
                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
            </div>
        </div>
        <div class="form-group form-section">
            <label for="datepicker" class="light-label">Handover Date<span class="req">*</span></label>
            <div class="input-group date" id="datepicker">
                <input type="text" class="form-control required-field" placeholder="YYYY-MM-DD" name="year_build">
                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
            </div>
        </div>          
        <div class="form-group form-section">
            <label for="property_age" class="light-label">Tower</label>
            <input type="property_age" placeholder="Tower" id="towers" name="towers" class="form-control required-field">
        </div>
        <div class="form-group form-section">
            <label for="property_age" class="light-label">Units</label>
            <input type="property_age" placeholder="Units" id="units" name="units" class="form-control required-field">
        </div>
        <div class="form-group form-section">
            <label for="total_area" class="light-label">Total Area (in Sq.ft.)</label>
            <input type="text" placeholder="Total area" id="total_area" name="total_area" class="form-control required-field">                            
        </div>     
        <div class="form-group form-section">
            <label class="light-label">Brokerage?</label><br />
            <div class="custom-radio required-group">
                <input type="radio" class="btn-check" name="brokerage" id="is_yes" value="1" autocomplete="off"
                    {{ (isset($property) && $property->brokerage == 1) ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                <label class="btn-radio" for="is_yes">Yes</label>

                <input type="radio" class="btn-check" name="brokerage" id="is_no" value="0" autocomplete="off"
                    {{ (isset($property) && $property->brokerage == 0) ? 'checked' : '' }}>
                <label class="btn-radio" for="is_no">No</label>
            </div>
            <p class="error"></p>
        </div>
        </div>
    </div>
     
    
    

<a class="basic-link" href="#" data-bs-toggle="modal" data-bs-target="#similarModal">+ Add Similar Properties</a>
<div class="modal fade bd-example-modal-lg" id="similarModal" tabindex="-1" aria-labelledby="similarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content login-modal">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">Add Similar Properties</div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="custom-checkbox-group">                
                        @php
                            $selectedRelated = [];
                        @endphp

                        @if (!empty($relatedProperties))
                            @foreach ($relatedProperties as $value)
                                    <label class="custom-checkbox">
                                        <input type="checkbox" class="related_properties" value="{{ $value->id }}">
                                        <span class="btn-checkbox">{{ $value->title }}</span>
                                        
                                    </label>                        
                            @endforeach
                        @endif
                    </div>
                    <input type="hidden" name="related_properties_json" id="related_properties_json">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Save</button>
            </div>
        </div>
    </div>
</div>

<div id="image" class="dropzone dz-clickable">
    <div class="dz-message needsclick">
        <br>Drop files here or click to upload.<br><br>
    </div>
</div>
<div class="row" id="product-gallery"></div> 

{{-- <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#mediaModal">+ Add Photos</a>
<div class="modal fade bd-example-modal-lg" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content login-modal">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">Add Photos</div>
            <div class="modal-body">
                 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Save</button>
            </div>
        </div>
    </div>
</div> --}}

<h5 class="mt-4">Choose Your Plan</h5>

<div class="plans-container mt-3">
    <div class="row">
        @foreach($plans as $plan)
            <div class="col-md-4 col-12">
                <label class="plan-card">
                    <input type="radio" name="plan_id" value="{{ $plan->id }}" required {{ $plan->name === 'Gold' ? 'checked' : '' }}>
                    <div class="plan-header">
                        {{ $plan->name }}
                    </div>
                    <div class="plan-body">
                        <div class="price">
                            @if($plan->price > 0)
                                Rs.{{ $plan->price }}/<span>Month</span>
                            @else
                                Free
                            @endif
                        </div>

                        <ul class="features">
                            @foreach(json_decode($plan->features) as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>

                        <span class="btn btn-primary">Select Plan</span>
                    </div>
                </label>
            </div>
        @endforeach
    </div>    
</div>

<button type="submit" id="createBtn" class="btn btn-primary big-btn">Create</button>