@extends('front.layouts.app')

@section('main')

<div class="rh-custom-search-form-gutter clearfix"></div>
<div class="rh-home-content">
	<div class="elementor elementor-130">
		@include('front.home.search.index')
		
    <div class="carousalHome">
      <div><img src="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/06/Beautiful-House.jpg" /></div>
      <div><img src="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/06/bathroom-02.jpg" /></div>
  </div>
  
		@include('front.home.latestProperties')
		{{-- @include('front.home.mainProperty') --}}
		@include('front.home.finding')
		@include('front.home.agents')
		@include('front.home.discoverPropeties')		
	</div>
</div>

@endsection
@section('customJs')
<script type="text/javascript">
    function interested(id){
        $.ajax({
            url: '{{ route("applyProperty") }}',
            type: 'post',
            data: {id:id},
            dataType: 'json',
            success: function(response){
                window.location.href = "{{ url()->current() }}";
            }
        });
    }

    function saveProperty(id){
        $.ajax({
            url: '{{ route("saveProperty") }}',
            type: 'post',
            data: {id:id},
            dataType: 'json',
            success: function(response){
                window.location.href = "{{ url()->current() }}";
            }
        });
    }
</script>