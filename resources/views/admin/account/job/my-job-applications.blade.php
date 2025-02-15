@extends('admin.layouts.app')

@section('content')
<section class="section-5 bg-2">
    <div class="container-fluid">
        @include('admin.layouts.message')
        <div class="card border-0 shadow mb-4 p-3">
            <div class="card-body card-form">
                <div class="d-flex justify-content-between">
                    <h3 class="fs-4 mb-1">Interested</h3>
                </div>
                <div class="table-responsive">
                    <table class="table ">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Saved Date</th>
                                <th scope="col">Interested</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @if ($jobApplications->isNotEmpty())
                                @foreach ($jobApplications as $jobApplication)
                                <tr class="active">
                                    <td>
                                        <div class="job-name fw-500">{{ $jobApplication->job->title }}</div>
                                        <div class="info1">{{ $jobApplication->job->jobType->name }} . {{ $jobApplication->job->location }}</div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($jobApplication->created_at)->format('d M, Y') }}</td>
                                    <td>{{ $jobApplication->job->applications->count() }} Applications</td>
                                    <td>
                                        @if ($jobApplication->job->status == 1)
                                            <div class="job-status text-capitalize">Active</div>
                                        @else
                                            <div class="job-status text-capitalize">Block</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-dots float-end">
                                            <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="{{ route('propertyDetails', $jobApplication->job_id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="removeProperty({{ $jobApplication->id }})"><i class="fa fa-edit" aria-hidden="true"></i> Remove Job</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">people not found</td>
                                    </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{ $jobApplications->links() }}
            </div>
        </div>
    </div>       
</section>
@endsection

@section('customJs')
<script type="text/javascript">
    function removeProperty(id){
        if(confirm("Are you sure you want to remove?")){
                $.ajax({
                url: '{{ route("account.removeProperties") }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response){
                    window.location.href='{{ route("account.myPropertyApplications") }}';
            }
            });
        }
    }
</script>
@endsection
