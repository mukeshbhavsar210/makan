@extends('admin.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>My Properties</h1>
                </div>            
                <div class="col-sm-6 text-right">
                    <a href="{{ route('property.create' )}}" class="btn btn-primary">Post a Property</a>
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
                                    <th scope="col">Image</th>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Posted</th>
                                    <th scope="col">Interested</th>
                                    <th scope="col">Showing</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="border-0">
                                @if ($properties->isNotEmpty())
                                    @foreach ($properties as $value)
                                    <tr class="active">
                                        <td>
                                            @php
                                                $propertyImage = $value->property_images->first();
                                            @endphp

                                            @if (!empty($propertyImage->image))
                                                    <img class="card-img-top" src="{{ asset('uploads/property/small/'.$propertyImage->image) }}" style="width: 60px" >
                                                @else
                                                    <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" style="width: 60px"  />
                                            @endif
                                        </td>   
                                        <td>{{ $value->title }}</td>                                     
                                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</td>
                                        <td>0 Applications</td>
                                        <td>
                                            @if ($value->is_featured == 'Yes')
                                                <div class="job-status text-capitalize">Approved</div>
                                            @else
                                                <div class="job-status text-capitalize">Rejected</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($value->status == 1)
                                                <div class="job-status text-capitalize">Active</div>
                                            @else
                                                <div class="job-status text-capitalize">Block</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('propertyDetails', $value->id) }}" target="_blank"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{ route('property.edit', $value->id ) }}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </a>
                                            <a href="#" onclick="deleteJob({{ $value->id }})" class="text-danger w-4 h-4 mr-1">
                                                <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                  </svg>
                                            </a>
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
    function deleteJob(propertyId){
        if(confirm("Are you sure you want to delete?")){
            $.ajax({
            url: '{{ route("property.delete") }}',
            type: 'post',
            data: { propertyId: propertyId },
            dataType: 'json',
            success: function(response){
                window.location.href='{{ route("property.index") }}';
            }
            });
        }
    }
</script>
@endsection
