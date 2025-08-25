@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <h1>Amenities <span class="badge rounded text-blue bg-blue-subtle">{{ $counts }}</span></h1>
            </div>      
            <div class="col-sm-3">
                <button type="button" class="btn btn-primary btn-sm pull-right" data-bs-toggle="modal" data-bs-target="#addAmenityModal">Add Amenity</button>                
            </div>      
        </div>
    </div>
</section>
<section>
    <div class="container-fluid">

        @include('admin.message')

        <div class="modal fade drawer right-align" id="addAmenityModal" tabindex="-1" role="dialog" aria-labelledby="areaModal" aria-modal="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title m-0" id="areaModal">Add Amenities</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" id="amenityForm" name="amenityForm">
                        <div class="modal-body">
                            <div class="modal-content">                                                            
                                  <div class="form-group">
                                    <label for="title">Amenities Name</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Amenity Name">
                                    <p></p>
                                </div>                                                      
                                <div class="form-group">
                                    <label for="icon">Icon</label>
                                    <input type="text" name="icon" id="icon" class="form-control" placeholder="Icon">
                                    <p></p>
                                </div>
                            </div>                                                                                                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Create Amenity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
        
        <div class="card">
            <div class="card-body table-responsive">
                <div class="table-responsive browser_users">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-top-0">Project Name</th>
                                <th class="border-top-0">Icon</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($amenities->isNotEmpty())
                                @foreach ($amenities as $value)
                                    <tr>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->icon }}</td>
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
                                            <a href="{{ route('amenities.edit', $value->id) }}"><i class="las la-pen text-secondary fs-18"></i></a>
                                            <a href="#" onclick="deleteAmenity( {{ $value->id }} )"><i class="las la-trash-alt text-secondary fs-18"></i></a>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</section>

@endsection
@section('customJs')
<script>
    $("#amenityForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("amenities.store") }}',
            type: 'post',
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

    function deleteAmenity(id){

        var url = '{{ route("amenities.delete","ID") }}'
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
                        window.location.href="{{ route('amenities.index') }}"
                    }
                }
            });
        }
    }
</script>
@endsection