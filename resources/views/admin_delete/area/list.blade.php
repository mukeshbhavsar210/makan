@extends('front.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <h1>Areas <span class="badge rounded text-blue bg-blue-subtle">{{ $counts }}</span></h1>
            </div>   
            <div class="col-sm-3">
                <button type="button" class="btn btn-primary btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#addAreaModal">Add Area</button>                
            </div>         
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        @include('front.message')

        <div class="modal fade drawer right-align" id="addAreaModal" tabindex="-1" role="dialog" aria-labelledby="areaModal" aria-modal="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="areaModal">Add Area</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" id="areaForm" name="areaForm">
                        <div class="modal-body">
                            <div class="modal-content">                                                            
                                <div class="form-group">
                                    <label for="name">Select City</label>
                                    <select name="city" id="city" class="form-control">
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
                                    <label for="name">Area Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Area Name">
                                    <p></p>
                                </div>                        
                                <div class="form-group d-none">
                                    <label for="slug">Slug</label>
                                    <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="">
                                    <p></p>
                                </div>
                            </div>                                                                                                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Create Area</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 

        <div class="row ">
            <div class="col-12">
                <div class="clearfix">
                    <ul class="nav nav-tabs" id="cityTabs" role="tablist">
                        @foreach($cities as $index => $city)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="city-{{ $city->id }}-tab" data-bs-toggle="tab" href="#city-{{ $city->id }}" role="tab" aria-selected="true">
                                    {{ $city->name }}
                                    <span class="badge rounded text-blue bg-blue-subtle ms-1">{{ $city->areas_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="tab-content" id="cityTabsContent">
                            @foreach($cities as $index => $city)
                                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="city-{{ $city->id }}" role="tabpanel" aria-labelledby="city-{{ $city->id }}-tab">
                                    <div class="table-responsive browser_users">
                                        <table class="table mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="border-top-0">Area Name</th>
                                                    <th class="border-top-0">Status</th>
                                                    <th class="border-top-0">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($areas->isNotEmpty())
                                                    @foreach($city->areas as $value)
                                                        <tr>
                                                            <td>{{ $value->name }}</td>
                                                            <td>   
                                                                @if($value->status == 1)
                                                                    <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                    </svg>
                                                                @else
                                                                <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                @endif
                                                            </td>
                                                            <td>   
                                                                <a href="{{ route('areas.edit', $value->id ) }}"><i class="las la-pen text-secondary fs-18"></i></a>
                                                                <a href="#" onclick="deleteArea({{ $value->id }})"><i class="las la-trash-alt text-secondary fs-18"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>                                              
                                    </div>
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
