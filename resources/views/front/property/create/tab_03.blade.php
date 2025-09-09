<div class="form-section" data-step="3">
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
            <label for="" class="light-label">Search Keywords</label>
            <input type="text" placeholder="Search keywords" id="keywords" name="keywords" class="form-control required-field">
        </div> 
        
        <div class="form-group form-section">
            <label for="rera" class="light-label">RERA<span class="req">*</span></label>
            <input type="text" placeholder="RERA" id="rera" name="rera" class="form-control required-field">                            
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
            <label class="light-label">Brokerage?</label><br />
            <div class="custom-radio">
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

       
    

{{-- <a href="{{ route('properties.index') }}" class="btn m-1 btn-outline-dark">Cancel</a> --}}

</div>

<button type="submit" id="createBtn" class="btn btn-primary big-btn">Create</button>