@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">           
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="progress-left">
                    <div class="card-body">
                        <h5 class="mb-4">Create Areas</h5>
                        <form action="" method="post" id="areaForm" name="areaForm">
                            <div class="form-group">
                                <label class="light-label" for="name">Select City</label>
                                <select name="city" id="city" class="form-select">
                                    <option value="">Select a City</option>
                                    @if($cities->isNotEmpty())
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p></p>                 
                            </div>                         
                            <div class="form-group">
                                <label class="light-label" for="name">Area Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Area Name">
                                <p></p>
                            </div>                        
                            <div class="form-group d-none">
                                <label class="light-label" for="slug">Slug</label>
                                <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="">
                                <p></p>
                            </div>
                            <button type="submit" class="btn btn-primary default-btn">Create Area</button>                        
                        </form>                       
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12">
                <div class="progress-right">
                    <h5>Areas <span class="counts">- {{ $counts }}</span></h5>
                    <ul class="nav nav-tabs" id="cityTabs" role="tablist">
                        @foreach($cities as $index => $city)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="city-{{ $city->id }}-tab" data-bs-toggle="tab" href="#city-{{ $city->id }}" role="tab" aria-selected="true">
                                    {{ $city->name }}
                                    <span class="counts">- {{ $city->areas_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                  
                    <div class="tab-content" id="cityTabsContent">
                        @foreach($cities as $index => $city)
                            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="city-{{ $city->id }}" role="tabpanel" aria-labelledby="city-{{ $city->id }}-tab">                                
                                
                                <div class="mt-3">@include('front.layouts.message')</div>

                                @if($areas->isNotEmpty())
                                    <div class="area-listing">
                                        @foreach($city->areas as $value)                                            
                                            <div class="details">
                                                <div>{{ $value->name }}</div>
                                                <div class="icon"><a href="#" onclick="deleteArea({{ $value->id }})"><i class="fa-solid fa-trash"></i></a></div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>   
                </div>
            </div>
        </div>
    </div>                   
</section>

@endsection
@section('customJs')
<script>
    $('#name').change(function(){
        element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);
                if(response["status"] == true){
                    $("#slug").val(response["slug"]);
                }
            }
        });
    })


    $("#areaForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("areas.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);

                if(response["status"] == true){
                    window.location.href="{{ route('areas.index') }}"
                    $('#name').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");

                } else {
                    var errors = response['errors']
                    if(errors['name']){
                        $('#name').addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);
                    } else {
                        $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }
                }

            }, error: function(jqXHR, exception) {
                console.log("Something event wrong");
            }
        })
    });

    function deleteArea(id){
        var url = '{{ route("areas.delete","ID") }}'
        var newUrl = url.replace("ID",id)

        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    if(response["status"]){
                        window.location.href="{{ route('areas.index') }}"
                    }
                }
            });
        }
    }
</script>
@endsection
