

<div class="form-group">
    <label for="" class="light-label">Description<span class="req">*</span></label>
    <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>                            
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="property_age" class="light-label">Property Age<span class="req">*</span></label>
            <select name="property_age" id="property_age" class="form-select">
                <option value="">Select Property Age</option>
                <option value="1_year">Less than 1 year</option>
                <option value="3_years">Less than 3 years</option>
                <option value="5_years">Less than 5 years</option>
                <option value="6_years">More than 5 years</option>
            </select>
        </div>  
    </div>
    <div class="col-md-3">
         <div class="form-group">
            <label for="total_area" class="light-label">Total Area (in Sq.ft.)</label>
            <input type="text" placeholder="Total area" id="total_area" name="total_area" class="form-control">                            
        </div>
    </div> 
    <div class="col-md-3">
        <div class="form-group">
            <label for="property_age" class="light-label">Tower</label>
            <input type="property_age" placeholder="Tower" id="towers" name="towers" class="form-control">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="property_age" class="light-label">Units</label>
            <input type="property_age" placeholder="Units" id="units" name="units" class="form-control">
        </div>
    </div>

    <h4 class="mt-3">Builder details</h4>
    <div class="col-md-8">
        <div class="form-group">   
            <label class="light-label">Select Builder</label>   
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
            <label for="year_build" class="light-label">Year Build<span class="req">*</span></label>
            <div class="input-group date" id="year_build">
                <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="year_build" value="">
                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-12">
        <div class="form-group">
            <label for="" class="light-label">Search Keywords</label>
            <input type="text" placeholder="Search keywords" id="keywords" name="keywords" class="form-control">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="datepicker" class="light-label">Handover Date<span class="req">*</span></label>
            <div class="input-group date" id="datepicker">
                <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="year_build">
                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="rera" class="light-label">RERA<span class="req">*</span></label>
            <input type="text" placeholder="RERA" id="rera" name="rera" class="form-control">                            
        </div>
    </div>
</div>

<div class="form-group">
    <label class="light-label">Constructions Type?</label><br />
    <div class="custom-radio">
        <input type="radio" class="btn-check" name="construction_types" id="is_construction_under" value="under" autocomplete="off"
            {{ (isset($property) && $property->construction_types == 'under') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
        <label class="btn-radio" for="is_construction_under">Under Construction</label>

        <input type="radio" class="btn-check" name="construction_types" id="is_construction_ready" value="ready" autocomplete="off"
            {{ (isset($property) && $property->construction_types == 'ready') ? 'checked' : '' }}>
        <label class="btn-radio" for="is_construction_ready">Ready to Move</label>
    </div>
    <p class="error"></p>
</div>

<div class="form-group">
    <label id="similarCounts" class="light-label">Similar Properties <span class="req">*</span></label>
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

<div class="form-group">
    <label id="facingsCounts" class="light-label">Facings <span class="req">*</span></label>
    <div class="custom-checkbox-group">
        @php
            $selectedFacings = old('facings_json') ? json_decode(old('facings_json'), true) : [];
        @endphp

        <div class="custom-checkbox-group">
            <label class="custom-checkbox">
                <input type="checkbox" class="facings" value="east" {{ in_array('east', $selectedFacings) ? 'checked' : '' }}> 
                <span class="btn-checkbox">East</span>
            </label>
            <label class="custom-checkbox">
                <input type="checkbox" class="facings" value="west" {{ in_array('west', $selectedFacings) ? 'checked' : '' }}> 
                <span class="btn-checkbox">West</span>
            </label>
            <label class="custom-checkbox">
                <input type="checkbox" class="facings" value="north" {{ in_array('north', $selectedFacings) ? 'checked' : '' }}> 
                <span class="btn-checkbox">North</span>
            </label>
            <label class="custom-checkbox">
                <input type="checkbox" class="facings" value="south" {{ in_array('south', $selectedFacings) ? 'checked' : '' }}> 
                <span class="btn-checkbox">South</span>
            </label>
        </div>
    </div>
    <input type="hidden" name="facings_json" id="facings_json">
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

<div class="card-footer">
    <div class="pull-right mb-3">
        <a href="{{ route('properties.index') }}" class="btn m-1 btn-outline-dark">Cancel</a>
        <button type="submit" id="createBtn" class="btn btn-primary big-btn">Create</button>                         
    </div>
</div>