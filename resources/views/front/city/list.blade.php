@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">           
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="progress-left">
                    <div class="card-body">
                        <h1>Cities <span class="badge rounded text-blue bg-blue-subtle">{{ $counts }}</span></h1>                        

                        <form action="" method="post" id="cityForm" name="cityForm">
                            <div class="form-group">
                                <label class="light-label" for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="City Name">
                                <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="">
                                <p></p>
                            </div>                                                    
                            <button type="submit" class="btn btn-primary default-btn">Create City</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12">
                <div class="progress-right">
                    @include('front.layouts.message')

                    <table class="table mb-0">
                      
                        <tbody>
                            @if($cities->isNotEmpty())
                                @foreach ($cities as $value)
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
                                            <a href="{{ route('cities.edit', $value->id ) }}">Edit</a>
                                            <a href="#" onclick="deleteCity({{ $value->id }})">Delete</a>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
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
            url: '{{ route("cities.edit", ":id") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);

                if(response["status"] == true){
                    window.location.href="{{ route('cities.index') }}"
                    $('#title').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");

                } else {
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
                        window.location.href="{{ route('cities.index') }}"
                    }
                }
            });
        }
    }
</script>
@endsection
