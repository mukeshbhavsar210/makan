@extends('front.layouts.app')

@section('main')

<div class="rh-ultra-properties-half-map">
   @include('front.propertyMap.map')
   @include('front.propertyMap.results')
</div>
@endsection

@section('customJs')
<script>
    $("#city").change(function(){
        var city_id = $(this).val();
        $.ajax({
            url: '{{ route("areaSub.index") }}',            
            type: 'get',
            data: {city_id:city_id},
            dataType: 'json',
            success: function(response) {
                $("#area").find("option").not(":first").remove();
                $.each(response["subAreas"],function(key,item){
                    $("#area").append(`<option value='${item.id}' >${item.name}</option>`)
                })
            },
            error: function(){
                console.log("Something went wrong")
            }
        });
    })

   $("#searchForm").submit(function(e){
       e.preventDefault();
   
       var url = '{{ route("properties") }}?';
   
       //if keyword has a value
       var keyword = $("#keyword").val();
       if(keyword != ""){
           url += '&keyword=' + keyword;
       }     
       
       //Price range filter
       //url += '&price_min='+slider.result.from+'&price_max='+slider.result.to;
   
       //if category has a value
       var city = $("#city").val();
       if(city != ""){
           url += '&city=' + city;
       }

       //if category has a value
       var area = $("#area").val();
       if(area != ""){
           url += '&area=' + area;
       }

       //if bathrooms has a value
       var bathroom = $("#bathroom").val();
       if(bathroom != ""){
           url += '&bathroom=' + bathroom;
       }

       //if rooms has a value
       var room = $("#room").val();
       if(room != ""){
           url += '&room=' + room;
       }

       //if category has a value
       var type = $("#type").val();
       if(type != ""){
           url += '&type=' + type;
       }       

       //if category has a value
       var category = $("#category").val();
       if(category != ""){
           url += '&category=' + category;
       }       
     
        // //if user checked job type
        // var checkedJobTypes = $("input:checkbox[name='job_type']:checked").map(function(){
        //     return $(this).val();
        // }).get();

        // if(checkedJobTypes.length > 0){
        //     url += '&jobType=' + checkedJobTypes;
        // }
   
       //Sort filter
       var sort = $("#sort").val();
       url += '&sort=' + sort;
   
       window.location.href=url;
   })



   
   $("#sort").change(function(){
       $("#searchForm").submit();
   });

   $("#bathroom").change(function(){
       $("#searchForm").submit();
   });

   $("#room").change(function(){
       $("#searchForm").submit();
   });
   
   $("#category").change(function(){
       $("#searchForm").submit();
   });

//    $("#city").change(function(){
//        $("#searchForm").submit();
//    });

   $("#area").change(function(){
       $("#searchForm").submit();
   });

   $("#type").change(function(){
       $("#searchForm").submit();
   });
   
</script>
@endsection