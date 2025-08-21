@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Area</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('areas.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        <form action="" method="post" id="areaFormUpdate" name="areaFormUpdate">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Area</label>
                                <input type="text" value="{{ $area->name}}" name="name" id="name" class="form-control" placeholder="Name">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">City</label>
                                <select name="city_id" id="city" class="form-control">
                                    <option value="">Select a City</option>
                                    @if($city->isNotEmpty())
                                        @foreach ($city as $value)
                                            <option value="{{ $value->id }}" {{ $area->city_id == $value->id ? 'selected' : '' }}>
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <p></p>                 
                            </div>
                        </div>
                        <div class="col-md-4 d-none">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ ($area->status == 1 ? 'selected' : '')}} value="1">Active</option>
                                    <option  {{ ($area->status == 0 ? 'selected' : '')}} value="0">Block</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('areas.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
        
        $("#areaFormUpdate").submit(function(event){
    event.preventDefault();

    var element = $(this);
    $("button[type=submit]").prop('disabled', true);

    // Add _method=PUT for Laravel
    var formData = element.serializeArray();
    formData.push({name: "_method", value: "PUT"});

    $.ajax({
        url: '{{ route("areas.update", $area->id) }}',
        type: 'POST', // ✅ Laravel interprets PUT via _method
        data: formData,
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled', false);

            if(response.status === true){
                window.location.href = "{{ route('areas.index') }}";
                $('#name').removeClass('is-invalid')
                          .siblings('p')
                          .removeClass('invalid-feedback')
                          .html("");
            } else {
                if(response.notFound === true){
                    window.location.href = "{{ route('areas.index') }}";
                }
                var errors = response.errors || {};
                if(errors.name){
                    $('#name').addClass('is-invalid')
                              .siblings('p')
                              .addClass('invalid-feedback')
                              .html(errors.name);
                } else {
                    $('#name').removeClass('is-invalid')
                              .siblings('p')
                              .removeClass('invalid-feedback')
                              .html("");
                }
            }
        },
        error: function(jqXHR, exception) {
            $("button[type=submit]").prop('disabled', false);
            console.log("Something went wrong", jqXHR.responseText);
        }
    });
});

    </script>
@endsection
