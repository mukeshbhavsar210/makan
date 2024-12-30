@extends('front.layouts.app')

@section('main')

<div class="rh-ultra-properties-half-map">
   @include('front.property.map')
   @include('front.property.results')
</div>

@endsection

@section('customJs')
<script>
   $("#searchForm").submit(function(e){
       e.preventDefault();
   
       var url = '{{ route("jobs") }}?';
   
       //if keyword has a value
       var keyword = $("#keyword").val();
       if(keyword != ""){
           url += '&keyword=' + keyword;
       }
   
       //if location has a value
       var location = $("#location").val();
       if(location != ""){
           url += '&location=' + location;
       }
   
       //if category has a value
       var category = $("#category").val();
       if(category != ""){
           url += '&category=' + category;
       }
   
       //if amenities has a value
       var amenity = $("#amenity").val();
       if(amenity != ""){
           url += '&amenity=' + amenity;
       }
   
       //if experience has a value
       var experience = $("#experience").val();
       if(experience != ""){
           url += '&experience=' + experience;
       }
   
       //if user checked job type
       var checkedJobTypes = $("input:checkbox[name='job_type']:checked").map(function(){
           return $(this).val();
       }).get();
   
       if(checkedJobTypes.length > 0){
           url += '&jobType=' + checkedJobTypes;
       }
   
       //Sort filter
       var sort = $("#sort").val();
       url += '&sort=' + sort;
   
       window.location.href=url;
   })
   
   // $("#sort").change(function(){
   //     $("#searchForm").submit();
   // });
   
   // $("#category").change(function(){
   //     $("#searchForm").submit();
   // });
   
   // $("#experience").change(function(){
   //     $("#searchForm").submit();
   // });
   
   // $("#keyword").keydown(function(){
   //     $("#searchForm").submit();
   // });
   
   // $("#location").keydown(function(){
   //     $("#searchForm").submit();
   // });
</script>
@endsection