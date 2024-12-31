
<div class="rhea_prop_search__option rhea_prop_locations_field rhea_location_prop_search_0 rhea-ultra-field-separator location-separator_0 rhea_prop_search__select" style="order: 1" data-key-position="1" data-get-location-placeholder="All Main Locations">
    <span class="rhea_prop_search__selectwrap ">
       <div class="dropdown bootstrap-select show-tick rhea_multi_select_picker_location bs3" >

         <input value="{{ Request::get('location') }}" type="text" name="location" id="location" placeholder="Location" class="form-control">

         {{-- <select name="location" id="location" class="rhea_multi_select_picker show-tick">
            <option value="">All Main Locations</option>
            @if ($locations)
                  @foreach ($locations as $value)
                     <option {{ (Request::get('location') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
            @endif
         </select> --}}
                                             
          {{-- <select id="27a00c8location" class="rhea_multi_select_picker_location show-tick" data-size="5.5" data-none-results-text="No results matched{0}" data-none-selected-text="All Main Locations" data-live-search="true" data-max-options="1" name="location[]" tabindex="-98">
             <option value="any" selected="selected">All Main Locations</option>
             <option value="{{ Request::get('location') }}">Ahmedabad</option>             
          </select> --}}

       </div>
    </span>
 </div>