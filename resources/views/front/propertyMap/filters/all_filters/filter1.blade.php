
<div class="rhea_prop_search__option rhea_prop_locations_field rhea_location_prop_search_0 rhea-ultra-field-separator location-separator_0 rhea_prop_search__select" style="order: 1" data-key-position="1" data-get-location-placeholder="All Main Locations">
    <span class="rhea_prop_search__selectwrap ">
       <div class="dropdown bootstrap-select show-tick rhea_multi_select_picker_location bs3" >
         <select name="city" id="city" class="rhea_multi_select_picker show-tick">
            <option value="">All Main Locations</option>
            @if ($cities)
                  @foreach ($cities as $value)
                     <option {{ (Request::get('city') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
            @endif
         </select>
       </div>
    </span>
 </div>