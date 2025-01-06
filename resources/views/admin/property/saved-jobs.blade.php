@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Saved Properties</h1>
            </div>            
            <div class="col-sm-6 text-right">
               
            </div>
        </div>
    </div>
</section>

<section class="section-5 bg-2">
    <div class="container-fluid">
    @include('admin.layouts.message')

    <div class="card">
        <div class="card-body table-responsive p-0">
           
            <div class="table-responsive">
                <table class="table ">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">Project Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">City</th>
                            <th scope="col">Interested</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border-0">
                        @if ($savedProperties->isNotEmpty())
                            @foreach ($savedProperties as $value)
                            <tr class="active">
                                <td>{{ $value->property->title }}</td>
                                <td>Rs.{{ $value->property->price }}.00</td>
                                <td>{{ $value->property->location }}</td>
                                <td>{{ $value->property->applications->count() }} Interested</td>
                                <td>
                                    @if ($value->property->status == 1)
                                        <div class="job-status text-capitalize">Active</div>
                                    @else
                                        <div class="job-status text-capitalize">Block</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('propertyDetails', $value->property_id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="#" onclick="removeProperty({{ $value->id }})"><i class="fa fa-edit" aria-hidden="true"></i></a>
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
            {{ $savedProperties->links() }}
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
