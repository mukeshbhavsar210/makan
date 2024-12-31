@extends('front.layouts.app')

@section('main')

<div class="rh-custom-search-form-gutter clearfix"></div>
<div class="rh-home-content">
	<div class="elementor elementor-130">
		@include('front.home.search.index')
		@include('front.home.carousalHome')
		@include('front.home.latestProperties')
		{{-- @include('front.home.mainProperty') --}}
		@include('front.home.finding')
		@include('front.home.agents')
		@include('front.home.discoverPropeties')		
	</div>
</div>

	{{-- @if ($latestJobs->isNotEmpty())
		@foreach ($latestJobs as $latestJob)
			{{ $latestJob->title }}
			{{ Str::words(strip_tags($latestJob->description), 5) }}
			{{ $latestJob->location }}
			{{ $latestJob->jobType->name }}
			<a href="{{ route('propertyDetails', $latestJob->id) }}" class="btn btn-primary btn-lg">Details</a>
		@endforeach
	@endif --}}

{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image"  name="image">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mx-3">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </form>
      </div>
    </div>
  </div>
</div> --}}

@endsection