<div class="rhea_prop_search__option rhea_prop_search__select rhea_status_field rhea-ultra-field-separator" style="order: 2" data-key-position="2" id="status-27a00c8">
    <span class="rhea_prop_search__selectwrap ">
       <div class="dropdown bootstrap-select show-tick rhea_multi_select_picker bs3" style="width: 100%;">
         @if ($jobTypes->isNotEmpty())
            @foreach ($jobTypes as $jobType)
               <input {{ (in_array($jobType->id, $jobTypeArray)) ? 'checked' : ''}} name="job_type" type="checkbox" value="{{ $jobType->id }}" id="job-type-{{ $jobType->id }}">
               <label for="job-type-{{ $jobType->id }}">{{ $jobType->name }}</label>               
            @endforeach
         @endif             

          {{-- <select class="rhea_multi_select_picker show-tick">
             <option value="any" selected="selected">Amenities</option>               
          </select> --}}
       </div>
    </span>
 </div>