@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Create Builder</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('builders.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="" method="post" id="builderForm" name="builderForm">
            <div class="card">
                <div class="card-body">
                    <div class="row"> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="hidden" id="image_id" name="image_id" value=" ">
                                <label for="image">Logo</label>
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                        <p></p>
                                    </div>
                                </div>                          
                                <div class="col-md-3">  
                                    <div class="form-group">                          
                                    <label for="property">Property</label>
                                    <select name="property" id="property" class="form-control">
                                        <option value="">Select a Property</option>
                                        @if($properties->isNotEmpty())
                                            @foreach ($properties as $value)
                                                <option value="{{ $value->id }}">{{ $value->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>                            
                                    </div>                       
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="year_estd">Year Estd.</label>
                                        <input type="text" name="year_estd" id="year_estd" class="form-control" placeholder="Year Estd.">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                        <p></p>
                                    </div>
                                </div>                        
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="whatsapp">Whatsapp</label>
                                        <input type="text" name="whatsapp" id="whatsapp" class="form-control" placeholder="Whatsapp">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="landline">Landline</label>
                                        <input type="text" name="landline" id="landline" class="form-control" placeholder="Landeline">
                                        <p></p>
                                    </div>
                                </div>
                            </div>  
                        </div>          
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('builders.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
    <script>
        $("#profilePicForm").submit(function(event){
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '{{ route("profile.updatePic") }}',
            type: 'post',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response){
                if(response.status == false){
                    var errors = response.errors;
                    if(errors.image){
                        $("#image-error").html(errors.name);
                    }
                } else {
                    window.location.href='{{ url()->current() }}'
                }
            },
            error: function(JQXHR, exception){
                console.log("Something went wrong");
            }
        })
    });



    
        $("#builderForm").submit(function(event){
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("builders.store") }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $("button[type=submit]").prop('disabled', false);

                    if(response["status"] == true){

                        window.location.href="{{ route('builders.index') }}"

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
    </script>
@endsection