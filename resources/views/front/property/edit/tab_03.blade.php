<div class="form-section" data-step="3">
<h5>Add Developer Details</h5>
<div class="row">
    <div class="col-md-9">
        <div class="form-group">
            <label for="" class="light-label">Description<span class="req">*</span></label>
            <textarea class="form-control"  name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $property->description}}</textarea>                            
        </div>
        <div class="form-group">
            <label for="" class="light-label">Developer<span class="req">*</span></label>
            @if ($user->role === 'Admin' || $user->role === 'User' || $user->role === 'Agent')
                <select name="builder" id="builder" class="form-select">
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
                <input type="text" class="form-control" value="{{ $builder->developer_name }}" readonly>
                <input type="hidden" name="builder" value="{{ $builder->id }}">
            @endif
        </div>
        <div class="form-group">
            <label for="" class="light-label">Search Keywords</label>
            <input type="text" value="{{ $property->keywords }}" id="keywords" name="keywords" class="form-control">
        </div>
        <div class="form-group">
            <label for="rera" class="light-label">RERA<span class="req">*</span></label>
            <input type="text" value="{{ $property->rera}}" id="rera" name="rera" class="form-control">                            
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
        <div class="form-group">
            <label for="year_build" class="light-label">Year Build<span class="req">*</span></label>
            <div class="input-group date" id="year_build">
                <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="year_build" value="{{ $property->year_build}}">
                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
            </div>
        </div>
        <div class="form-group">
            <label for="datepicker" class="light-label">Handover Date<span class="req">*</span></label>
            <div class="input-group date" id="datepicker">
                <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="year_build">
                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
            </div>
        </div>
        <div class="form-group">
            <label>Brokerage?</label><br />
            <div class="custom-radio">
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
<a href="{{ route('properties.index') }}" class="btn m-1 btn-outline-dark">Cancel</a>
<button type="submit" id="updateBtn" class="btn btn-primary m-1">Update</button>
