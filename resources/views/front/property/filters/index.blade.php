
<form action="" name="searchForm" id="searchForm">
    <input value="{{ Request::get('keyword') }}" type="text" name="keyword" id="keyword" placeholder="Keywords" class="form-control">

    <input value="{{ Request::get('location') }}" type="text" name="location" id="location" placeholder="Location" class="form-control">

    <select name="category" id="category" class="form-control">
       <option value="">Select a City</option>
       @if ($categories)
       @foreach ($categories as $category)
       <option {{ (Request::get('category') == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
       @endforeach
       @endif
    </select>

    <select name="amenity" id="amenity" class="form-control">
       <option value="">Select a Amenity</option>
       @if ($amenityType)
       @foreach ($amenityType as $value)
       <option {{ (Request::get('value') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
       @endforeach
       @endif
    </select>
 
    @if ($jobTypes->isNotEmpty())
    @foreach ($jobTypes as $jobType)
    <div class="form-check mb-2">
       <input {{ (in_array($jobType->id, $jobTypeArray)) ? 'checked' : ''}} class="form-check-input " name="job_type" type="checkbox" value=" {{ $jobType->id }}" id="job-type-{{ $jobType->id }}">
       <label class="form-check-label " for="job-type-{{ $jobType->id }}">{{ $jobType->name }}</label>
    </div>
    @endforeach
    @endif
 

    <select name="experience" id="experience" class="form-control">
       <option value="">BHK types</option>
       <option value="1" {{ (Request::get('experience') == 1) ? 'selected' : '' }} >1 BHK</option>
       <option value="2" {{ (Request::get('experience') == 2) ? 'selected' : '' }} >2 BHK</option>
       <option value="3" {{ (Request::get('experience') == 3) ? 'selected' : '' }} >3 BHK</option>
       <option value="4" {{ (Request::get('experience') == 4) ? 'selected' : '' }} >4 BHK</option>                    
       <option value="10_plus" {{ (Request::get('experience') == '10_plus') ? 'selected' : '' }}>5 BHK</option>
    </select>

    <select name="sort" id="sort" class="form-control">
    <option value="1" {{ (Request::get('sort') == '1') ? 'selected' : '' }}>Latest</option>
    <option value="0" {{ (Request::get('sort') == '0') ? 'selected' : '' }}>Oldest</option>
    </select>

    <button class="btn btn-primary" type="submit">Search</button>
 
    <a href="{{ route('jobs') }}" class="btn btn-secondary" type="submit" >Reset</a>
</form>


@if ($jobs->isNotEmpty())
    @foreach ($jobs as $job)
       <a href="{{ route('propertyDetails', $job->id) }}"><img class="img-fluid" src="img/property-1.jpg" alt=""></a>
       {{ $job->jobType->name }}
    
    <p>{{ Str::words(strip_tags($job->description), $words=10, '...') }}</p>
    
       {{-- {{ $job->amenityType->name }} --}}
       <a class="d-block h5 mb-2" href="{{ route('propertyDetails', $job->id) }}">{{ $job->title }}</a>
       {{ $job->location }}       
@endforeach
   <div> {{ $jobs->withQueryString()->links() }} </div>
@else
   <div>Property not found</div>
@endif
</section>