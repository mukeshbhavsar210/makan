@extends('admin.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>My Properties</h1>
                </div>            
                <div class="col-sm-6 text-right">
                    <a href="{{ route('account.createProperty' )}}" class="btn btn-primary">Post a Property</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @include('admin.message')

            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Posted</th>
                                    <th scope="col">Interested</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="border-0">
                                @if ($properties->isNotEmpty())
                                    @foreach ($properties as $value)
                                    <tr class="active">
                                        <td>{{ $value->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</td>
                                        <td>0 Applications</td>
                                        <td>
                                            @if ($value->status == 1)
                                                <div class="job-status text-capitalize">Active</div>
                                            @else
                                                <div class="job-status text-capitalize">Block</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('propertyDetails', $value->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{ route('account.editProperty', $value->id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            <a href="#" onclick="deleteJob({{ $value->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>

                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
<script>
    $("#userForm").submit(function(event){
        event.preventDefault();

        $("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{ route("account.updateProfile") }}',
            type: 'put',
            data: $("#userForm").serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type='submit']").prop('disabled', false);

                var errors = response.errors;

                if(response.status == false){
                    if(errors.name){
                        $("#name").siblings("p").addClass('invalid-feedback').html(errors.name);
                        $("#name").addClass('is-invalid');
                    } else {
                        $("#name").siblings("p").removeClass('invalid-feedback').html();
                        $("#name").removeClass('is-invalid');
                    }

                    if(errors.email){
                        $("#email").siblings("p").addClass('invalid-feedback').html(errors.email);
                        $("#email").addClass('is-invalid');
                    } else {
                        $("#email").siblings("p").removeClass('invalid-feedback').html();
                        $("#email").removeClass('is-invalid');
                    }

                    window.location.href="{{ route('account.profile') }}";

                } else {
                    $("#name").siblings("p").removeClass('invalid-feedback').html();
                    $("#name").removeClass('is-invalid');
                    $("#email").siblings("p").removeClass('invalid-feedback').html();
                    $("#email").removeClass('is-invalid');

                    window.location.href='{{ route("account.login") }}'
                }
            },
            error: function(JQXHR, exception){
                console.log("Something went wrong");
            }
        })
    });

    function deleteJob(jobId){
        if(confirm("Are you sure you want to delete?")){
            $.ajax({
            url: '{{ route("account.deleteProperty") }}',
            type: 'post',
            data: { jobId: jobId },
            dataType: 'json',
            success: function(response){
                window.location.href='{{ route("account.property") }}';
            }
            });
        }
    }
</script>
@endsection
