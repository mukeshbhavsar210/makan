@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit City</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('cities.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="" method="post" id="cityForm" name="cityForm">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" value="{{ $city->name}}" name="name" id="name" class="form-control" placeholder="Name">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" value="{{ $city->slug}}" readonly name="slug" id="slug" class="form-control" placeholder="">
                                <p></p>
                            </div>
                        </div>
                       
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ ($city->status == 1 ? 'selected' : '')}} value="1">Active</option>
                                    <option  {{ ($city->status == 0 ? 'selected' : '')}} value="0">Block</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
@endsection

@section('customJs')
    <script>
        $("#cityForm").submit(function(event){
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("cities.update",$city->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $("button[type=submit]").prop('disabled', false);

                    if(response["status"] == true){

                        window.location.href="{{ route('cities.index') }}"

                        $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");

                        $('#slug').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");

                    } else {

                        if(response['notFound'] == true){
                            window.location.href="{{ route('categories.index') }}"
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
    </script>
@endsection
