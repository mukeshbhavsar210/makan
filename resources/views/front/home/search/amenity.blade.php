<select name="amenity" id="amenity" class="form-control border-0 py-3">
    <option value="">Select Amenitiy</option>
    @if($amenities->isNotEmpty())
        @foreach ($amenities as $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endforeach
    @endif
</select>