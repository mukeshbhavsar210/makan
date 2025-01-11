@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Amenity</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('amenities.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section>
    <!-- Default box -->
    <div class="container-fluid">
        <form action="" method="post" id="amenityForm" name="amenityForm">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" value="{{ $amenity->title}}" name="title" id="title" class="form-control" placeholder="Title">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input type="text" value="{{ $amenity->icon}}" name="icon" id="icon" class="form-control" placeholder="Icon">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ ($amenity->status == 1 ? 'selected' : '')}} value="1">Active</option>
                                    <option  {{ ($amenity->status == 0 ? 'selected' : '')}} value="0">Block</option>
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
        $("#amenityForm").submit(function(event){
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("amenities.update",$amenity->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $("button[type=submit]").prop('disabled', false);

                    if(response["status"] == true){

                        window.location.href="{{ route('amenities.index') }}"

                        $('#title').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    } else {

                        if(response['notFound'] == true){
                            window.location.href="{{ route('amenities.index') }}"
                        }

                        var errors = response['errors']
                        if(errors['title']){
                            $('#title').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['title']);
                        } else {
                            $('#title').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        }
                    }

                }, error: function(jqXHR, exception) {
                    console.log("Something event wrong");
                }
            })
        });
    </script>
@endsection
