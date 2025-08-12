@extends('front.layouts.app')

@section('main')

<form action="{{ route('properties') }}">                                                       
    <div class="container-fluid">
        <span>Areas</span>
        @foreach ($areas as $value)
            <label>
                <input type="checkbox" name="area[]" value="{{ $value->id }}"
                    {{ is_array(request('area')) && in_array($value->id, request('area')) ? 'checked' : '' }}>
                {{ $value->name }}
            </label>
        @endforeach

        <div class="filters">
           <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="typeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Property Type
                </button>
                <ul class="dropdown-menu p-2" aria-labelledby="typeDropdown" style="min-width: 200px;">
                    @foreach ($types as $value)
                        <li>
                            <label class="dropdown-item custom-checkbox-label {{ is_array(request('type')) && in_array($value->id, request('type')) ? 'active' : '' }}">
                                <input type="checkbox" name="type[]" value="{{ $value->id }}"
                                    data-label="{{ $value->name }}"
                                    {{ is_array(request('type')) && in_array($value->id, request('type')) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                {{ $value->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="roomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    BHK Type
                </button>
                <ul class="dropdown-menu p-2" aria-labelledby="roomDropdown" style="min-width: 200px;">
                    @foreach ($rooms as $value)
                        <li>
                            <label class="dropdown-item custom-checkbox-label {{ is_array(request('room')) && in_array($value->id, request('room')) ? 'active' : '' }}">
                                <input type="checkbox" name="room[]" value="{{ $value->id }}"
                                    data-label="{{ $value->title }}"
                                    {{ is_array(request('room')) && in_array($value->id, request('room')) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                {{ $value->title }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col">
                <input type="text" class="js-range-slider" name="my_range" value="" />
            </div>
            <div class="col">
                <div style="display: none">
                    <select name="city" id="city" >
                        <option value="">City</option>
                        @if ($cities)
                            @foreach ($cities as $value)
                                <option {{ (Request::get('city') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col">
                <span>Bathrooms</span>
                @if ($bathrooms)
                    @foreach ($bathrooms as $value)
                        <label>
                            <input type="checkbox" 
                                name="bathroom[]" 
                                value="{{ $value->id }}"
                                {{ is_array(request('bathroom')) && in_array($value->id, request('bathroom')) ? 'checked' : '' }}>
                            {{ $value->title }}
                        </label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    
    <button class="rhea_search_form_button" type="submit"><span>Search</span></button>
</form>     

<div class="body-details">
    <div class="row">
        <div class="col-md-8 col-12">
            @if ($properties->isNotEmpty())
                @foreach ($properties as $value)                                     
                    <div class="propery-listings">
                        <div class="row">
                            <div class="col-md-4">
                                @php
                                    $propertyImage = $value->property_images->first();
                                @endphp
                                
                                @if (!empty($propertyImage->image))
                                    <a href="{{ route('propertyDetails', $value->id) }}" >
                                        <img loading="lazy" decoding="async" alt="" class="thumb" src="{{ asset('uploads/property/small/'.$propertyImage->image) }}" >
                                    </a>
                                @endif
                            </div>

                            <div class="col-md-8">
                                <div class="property-details">
                                    <div class="first-group">
                                        <h3 class="title">{{ $value->title }}</h3>
                                        <p>{{ $value->room->title }} {{ $value->propertyType->name }} in {{ $value->area->name }}.</p>
                                    </div>

                                    <div class="second-group">
                                        <p>{{ $value->room->title }} {{ $value->propertyType->name }}</p>
                                        <p>Rs.{{ $value->price }}/-</p>
                                    </div>
                                    
                                    <div class="developer">
                                        <a href="#" class="btn btn-primary">Contact</a>
                                        {{--
                                        Build: {{ $value->year_build }}
                                        <p class="added-date"><span class="added-title">Added:</span> {{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</p> --}}                                    
                                    </div>
                                    
                                    <p>Sizes: {{ $value->size }}</p>
                                    {{ $value->bathroom->title }}
                                    
                                    
                                    {{-- {{ Str::words(strip_tags($value->description), $words=10, '...') }} --}}
                            
                                        {{-- @if ($value->category->name == 'Rent')
                                            <span class="rh-ultra-featured">{{ $value->category->name }}</span>
                                        @else
                                            <span class="rh-ultra-hot">{{ $value->category->name }}</span>
                                        @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>      
                @endforeach
                    {{ $properties->withQueryString()->links() }}
                @else
                    <div>Property not found</div>
                @endif                                                                          
                    </div>
                </div>
            </div>
        </div>
    </div>
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
   
function updateDropdownLabel(dropdownId, inputSelector, defaultText) {
    var checked = $(inputSelector + ':checked');
    var button = $(dropdownId);

    if (checked.length === 0) {
        button.text(defaultText);
    } else {
        var names = checked.map(function () {
            return $(this).data('label');
        }).get();
        button.text(names.join(', '));
    }
}

$('.custom-checkbox-label input').on('change', function () {
    if ($(this).is(':checked')) {
        $(this).closest('.custom-checkbox-label').addClass('active');
    } else {
        $(this).closest('.custom-checkbox-label').removeClass('active');
    }

    updateDropdownLabel('#typeDropdown', 'input[name="type[]"]', 'Property Type');
    updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'Rooms');
});

// Initialize both dropdown labels on page load
updateDropdownLabel('#typeDropdown', 'input[name="type[]"]', 'Property Type');
updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'Rooms');
</script>
@endsection