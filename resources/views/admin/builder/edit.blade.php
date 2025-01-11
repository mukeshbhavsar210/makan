@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Builder</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('builders.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section>
    <!-- Default box -->
    <div class="container-fluid">
        <form action="" method="post" id="builderForm" name="builderForm">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" value="{{ $builder->name}}" name="name" id="name" class="form-control" placeholder="Name">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" value="{{ $builder->email}}" name="email" id="email" class="form-control" placeholder="Email">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" value="{{ $builder->mobile}}" name="mobile" id="mobile" class="form-control" placeholder="mobile">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" value="{{ $builder->address}}" name="address" id="address" class="form-control" placeholder="Address">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="landline">Landline</label>
                                <input type="text" value="{{ $builder->landline}}" name="landline" id="landline" class="form-control" placeholder="Landeline">
                                <p></p>
                            </div>
                        </div>      
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="whatsapp">Whatsapp</label>
                                <input type="text" value="{{ $builder->whatsapp}}" name="whatsapp" id="whatsapp" class="form-control" placeholder="Whatsapp">
                                <p></p>
                            </div>
                        </div>                   
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="year_estd">Year Estd.</label>
                                <input type="text" value="{{ $builder->year_estd}}" name="year_estd" id="year_estd" class="form-control" placeholder="Year Estd.">
                                <p></p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" id="image_id" name="image_id" value=" ">
                                <label for="image">Image</label>
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>
                            </div>

                            @if(!empty($builder->image))
                                <img style="border-radius: 7px; width:200px" src="{{ asset('uploads/category/thumb/'.$builder->image) }}" alt="" />
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ ($builder->status == 1 ? 'selected' : '')}} value="1">Active</option>
                                    <option  {{ ($builder->status == 0 ? 'selected' : '')}} value="0">Block</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('builders.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
@endsection

@section('customJs')
    <script>
        $("#builderForm").submit(function(event){
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("builders.update",$builder->id) }}',
                type: 'put',
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

                        if(response['notFound'] == true){
                            window.location.href="{{ route('builders.index') }}"
                        }

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
