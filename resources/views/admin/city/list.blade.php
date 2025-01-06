@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Settings</h1>
            </div>            
        </div>
    </div>    
</section>
 
<section class="content">
    <div class="container-fluid">
        @include('admin.message')

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a href="#cityTab" role="tab" data-toggle="tab"
                     class="nav-link active"> City </a>
                </li>
                <li class="nav-item">
                  <a href="#areaTab" role="tab" data-toggle="tab"
                     class="nav-link"> Area </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#categoryTab" role="tab" data-toggle="tab"
                       class="nav-link"> Category </a>
                  </li>         --}}
              </ul>
        
              <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="cityTab">
                  <div class="card">
                    
                    <form action="" method="get" >
                        <div class="card-header">
                            <div class="card-title">
                                <button type="button" onclick="window.location.href='{{ route('cities.create') }}'" class="btn btn-default btn-sm">Reset</button>
                            </div>
        
                            <div class="card-tools">
                                <div class="input-group input-group" style="width: 250px;">
                                    <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
        
                                    <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
        
                    <div class="card-body table-responsive p-0">
                        <form action="" method="post" id="cityForm" name="cityForm">           
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                    <td>
                                        <div class="form-group" style="margin-bottom: 0">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                            <p></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group" style="margin-bottom: 0">
                                            <label for="slug">Slug</label>
                                            <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="">
                                            <p></p>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary my-4">Add City</button> 
                                    </td>
                                </tbody>
                            </form>
        
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th width="60">ID</th>
                                        <th>City Name</th>
                                        <th>Slug</th>
                                        <th width="100">Status</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($cities->isNotEmpty())
                                        @foreach ($cities as $city)
                                            <tr>
                                                <td>{{ $city->id }}</td>
                                                <td>{{ $city->name }}</td>
                                                <td>{{ $city->slug }}</td>
                                                <td>
                                                    @if($city->status == 1)
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
                                                    <a href="{{ route('cities.edit', $city->id ) }}">
                                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="#" onclick="deleteCity({{ $city->id }})" class="text-danger w-4 h-4 mr-1">
                                                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">Records not found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
            
                        <div class="card-footer clearfix">
                            {{ $cities->links() }}
                        </div>
                    </div>
                </div>

                <div class="tab-pane" role="tabpanel" id="areaTab">
                    <div class="card">
                        <form action="" method="get" >
                            <div class="card-header">
                                <div class="card-title">
                                    <button type="button" onclick="window.location.href='{{ route('cities.create') }}'" class="btn btn-default btn-sm">Reset</button>
                                </div>
            
                                <div class="card-tools">
                                    <div class="input-group input-group" style="width: 250px;">
                                        <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
            
                                        <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    <div class="card-body table-responsive p-0">
                        <form action="" method="post" id="areaForm" name="areaForm">           
                            <table class="table table-hover text-nowrap">
                                <td>                         
                                    <div class="form-group">
                                        <label for="name">City</label>
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
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                        <p></p>
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary my-4">Add Area</button>
                                </td>
                            </table>                
                        </form>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="60">ID</th>
                                    <th>Area name</th>
                                    <th>City</th>                            
                                    <th width="100">Status</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($areas->isNotEmpty())
                                    @foreach ($areas as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->city->name }}</td>
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
                                                <a href="{{ route('areas.edit', $value->id ) }}">
                                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                    </svg>
                                                </a>
                                                <a href="#" onclick="deleteArea({{ $value->id }})" class="text-danger w-4 h-4 mr-1">
                                                    <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                      </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Records not found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
        
                    <div class="card-footer clearfix">
                        {{ $areas->links() }}
                    </div>
                    </div>
                </div>

                <div class="tab-pane" role="tabpanel" id="categoryTab">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <form action="" method="post" id="categoryForm" name="categoryForm">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2 my-4">
                                                <button type="submit" class="btn btn-primary">Create</button>                                    
                                            </div>
                                            
                                            {{-- <div class="col-md-6">
                                                <div class="mb-3">
                                                    <input type="hidden" id="image_id" name="image_id" value=" ">
                                                    <label for="image">Image</label>
                                                    <div id="image" class="dropzone dz-clickable">
                                                        <div class="dz-message needsclick">
                                                            <br>Drop files here or click to upload.<br><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            
                                        </div>
                                    </div>
                                </div>            
                            </form>
            
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th width="60">ID</th>
                                        <th>Name</th>
                                        <th width="100">Status</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                {{-- <td><img style="border-radius: 100px; width:35px; height:35px" src="{{ asset('uploads/category/'.$category->image) }}" alt="" /></td> --}}
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    @if($category->status == 1)
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
                                                    <a href="{{ route('categories.edit', $category->id ) }}">
                                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="#" onclick="deleteCategory({{ $category->id }})" class="text-danger w-4 h-4 mr-1">
                                                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                          </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">Records not found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
            
                        <div class="card-footer clearfix">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
        </div>              
    </div>    
</section>
@endsection

@section('customJs')
<script>

$("#cityForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("cities.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);

                if(response["status"] == true){

                    window.location.href="{{ route('cities.create') }}"

                    // $('#name').removeClass('is-invalid')
                    // .siblings('p')
                    // .removeClass('invalid-feedback').html("");

                    // $('#slug').removeClass('is-invalid')
                    // .siblings('p')
                    // .removeClass('invalid-feedback').html("");

                } else {
                    var errors = response['errors']
                    // if(errors['name']){
                    //     $('#name').addClass('is-invalid')
                    //     .siblings('p')
                    //     .addClass('invalid-feedback').html(errors['name']);
                    // } else {
                    //     $('#name').removeClass('is-invalid')
                    //     .siblings('p')
                    //     .removeClass('invalid-feedback').html("");
                    // }

                    // if(errors['slug']){
                    //     $('#slug').addClass('is-invalid')
                    //     .siblings('p')
                    //     .addClass('invalid-feedback').html(errors['slug']);
                    // } else {
                    //     $('#slug').removeClass('is-invalid')
                    //     .siblings('p')
                    //     .removeClass('invalid-feedback').html("");
                    // }

                }

            }, error: function(jqXHR, exception) {
                console.log("Something event wrong");
            }
        })
    });

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

                    window.location.href="{{ route('cities.create') }}"

                    $('#name').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");

                    $('#slug').removeClass('is-invalid')
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

                    if(errors['slug']){
                        $('#slug').addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['slug']);
                    } else {
                        $('#slug').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }

                }

            }, error: function(jqXHR, exception) {
                console.log("Something event wrong");
            }
        })
    });

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

    Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url:  "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#image_id").val(response.image_id);
                //console.log(response)
            }
        });



    function deleteCity(id){
        var url = '{{ route("cities.delete","ID") }}'
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
                        window.location.href="{{ route('cities.create') }}"
                    }
                }
            });
        }
    }

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
                        window.location.href="{{ route('cities.create') }}"
                    }
                }
            });
        }
    }


    $("#categoryForm").submit(function(event){
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("categories.store") }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $("button[type=submit]").prop('disabled', false);

                    if(response["status"] == true){

                        window.location.href="{{ route('cities.create') }}"

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


        Dropzone.autoDiscover = false;
            const dropzone = $("#image").dropzone({
                init: function() {
                    this.on('addedfile', function(file) {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }
                    });
                },
                url:  "{{ route('temp-images.create') }}",
                maxFiles: 1,
                paramName: 'image',
                addRemoveLinks: true,
                acceptedFiles: "image/jpeg,image/png,image/gif",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, success: function(file, response){
                    $("#image_id").val(response.image_id);
                    //console.log(response)
                }
            });


    function deleteCategory(id){

        var url = '{{ route("categories.delete","ID") }}'
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
                        window.location.href="{{ route('cities.create') }}"
                    }
                }
            });
        }
    }
</script>
@endsection
