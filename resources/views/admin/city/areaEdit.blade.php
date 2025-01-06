@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Area</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('cities.create') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="" method="post" id="areaForm" name="areaForm">
            <div class="card">
                <div class="card-body">
                    <div class="row">      
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" value="{{ $area->name}}" name="name" id="name" class="form-control" placeholder="Name">                                
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-3">      
                            <div class="form-group">                      
                            <label for="name">City</label>
                            <select name="city" id="city" class="form-control">
                                <option value="">Select a City</option>
                                @if ($cities->isNotEmpty())
                                    @foreach ($cities as $value)
                                        <option {{ ($value->city_id == $value->id) ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p></p>                            
                        </div>      
                        </div>                                          
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" value="{{ $area->slug}}" readonly name="slug" id="slug" class="form-control" placeholder="">
                                <p></p>
                            </div>
                        </div>                       
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ ($area->status == 1 ? 'selected' : '')}} value="1">Active</option>
                                    <option {{ ($area->status == 0 ? 'selected' : '')}} value="0">Block</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 my-4">
                            <button type="submit" class="btn btn-primary">Update</button>                
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>    
</section>
@endsection

@section('customJs')
    <script>
        $("#areaForm").submit(function(event){
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("areas.update",$area->id) }}',
                type: 'put',
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

                        if(response['notFound'] == true){
                            window.location.href="{{ route('cities.create') }}"
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
    </script>
@endsection
