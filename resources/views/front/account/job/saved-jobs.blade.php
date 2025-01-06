@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">

                @include('admin.layouts.message')

                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <h3 class="fs-4 mb-1">Saved Properties</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($savedJobs->isNotEmpty())
                                        @foreach ($savedJobs as $savedjob)
                                        <tr class="active">
                                            <td>
                                                <div class="job-name fw-500">{{ $savedjob->job->title }}</div>
                                                <div class="info1">{{ $savedjob->job->jobType->name }} . {{ $savedjob->job->location }}</div>
                                            </td>
                                            <td>{{ $savedjob->job->applications->count() }} Applications</td>
                                            <td>
                                                @if ($savedjob->job->status == 1)
                                                    <div class="job-status text-capitalize">Active</div>
                                                @else
                                                    <div class="job-status text-capitalize">Block</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-dots">
                                                    <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="{{ route('propertyDetails', $savedjob->job_id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="removeProperty({{ $savedjob->id }})"><i class="fa fa-edit" aria-hidden="true"></i> Remove Job</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">Property not found</td>
                                            </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $savedJobs->links() }}
                    </div>
                </div>
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
                url: '{{ route("account.removeSavedJob") }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response){
                    window.location.href='{{ route("property.savedProperties") }}';
            }
            });
        }
    }
</script>
@endsection
