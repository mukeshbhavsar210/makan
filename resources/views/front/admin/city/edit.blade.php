@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">           
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="progress-left">
                    <div class="card-body">
                        <h1>Cities</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12">
                <div class="progress-right">
                    <form action="" method="post" id="cityForm" name="cityForm">                            
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="light-label" for="name">City</label>
                                    <input type="text" value="{{ $city->name}}" name="name" id="name" class="form-control" placeholder="Name">
                                    <input type="text" readonly name="slug" id="slug" class="form-control d-none" placeholder="">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="light-label" for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ ($city->status == 1 ? 'selected' : '')}} value="1">Active</option>
                                        <option {{ ($city->status == 0 ? 'selected' : '')}} value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('cities.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                            </div>
                        </div>
                    </form>
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
                    } else {
                        if(response['notFound'] == true){
                            window.location.href="{{ route('cities.index') }}"
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
    </script>
@endsection
