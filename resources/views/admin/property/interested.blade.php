@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>My Interested</h1>
            </div>            
            <div class="col-sm-6 text-right">
                
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        @include('admin.layouts.message')

        <div class="card">
            <div class="card-body table-responsive p-0">
         
                <div class="table-responsive">
                    <table class="table ">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Property Name</th>
                                <th scope="col">City</th>
                                <th scope="col">Interested</th>
                                <th scope="col">Saved Date</th>                                
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @if ($interested->isNotEmpty())
                                @foreach ($interested as $value)
                                <tr class="active">
                                    <td>
                                        @php
                                            $PropertyImage = $value->property->property_images->first();
                                        @endphp
                                        <a href="{{ route('propertyDetails', $value->property_id) }}">
                                            @if ($PropertyImage && !empty($PropertyImage->image))
                                                <img src="{{ asset('uploads/property/small/' . $PropertyImage->image) }}"  width="150" alt="Property Image">
                                            @else
                                                <img src="{{ asset('admin-assets/img/default-150x150.png') }}" width="150" alt="Default Image">
                                            @endif
                                        </a><br />
                                        {{ $value->property->title }} <br />
                                        {{ $value->property->location }}, {{ $value->property->city->name ?? '' }}
                                    </td>                                    
                                    <td>{{ $value->property->applications->count() }} </td>
                                    <td>
                                         <div class="d-flex align-items-center">
                                            @foreach($value->property->applications as $application)
                                                <div class="user-avatar" title="{{ $application->user->name }}">
                                                    <img src="{{ asset('profile_pic/thumb/' . $application->user->image) }}" 
                                                        alt="{{ $application->user->name }}" 
                                                        class="rounded-circle">

                                                    <!-- Hover Card -->
                                                    <div class="user-details">
                                                        <strong>{{ $application->user->name }}</strong><br>
                                                        {{ $application->user->role }}<br>
                                                        <a href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a><br>
                                                        <a href="tel:{{ $application->user->mobile }}">{{ $application->user->mobile }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M Y') }}</td>
                                    <td>
                                        @if ($value->property->status == 1)
                                            <div class="job-status text-capitalize">Active</div>
                                        @else
                                            <div class="job-status text-capitalize">Block</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" onclick="removeProperty({{ $value->id }})">
                                            <svg width="30px" height="30px" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M667.8 362.1H304V830c0 28.2 23 51 51.3 51h312.4c28.4 0 51.4-22.8 51.4-51V362.2h-51.3z" fill="#CCCCCC" /><path d="M750.3 295.2c0-8.9-7.6-16.1-17-16.1H289.9c-9.4 0-17 7.2-17 16.1v50.9c0 8.9 7.6 16.1 17 16.1h443.4c9.4 0 17-7.2 17-16.1v-50.9z" fill="#CCCCCC" /><path d="M733.3 258.3H626.6V196c0-11.5-9.3-20.8-20.8-20.8H419.1c-11.5 0-20.8 9.3-20.8 20.8v62.3H289.9c-20.8 0-37.7 16.5-37.7 36.8V346c0 18.1 13.5 33.1 31.1 36.2V830c0 39.6 32.3 71.8 72.1 71.8h312.4c39.8 0 72.1-32.2 72.1-71.8V382.2c17.7-3.1 31.1-18.1 31.1-36.2v-50.9c0.1-20.2-16.9-36.8-37.7-36.8z m-293.5-41.5h145.3v41.5H439.8v-41.5z m-146.2 83.1H729.5v41.5H293.6v-41.5z m404.8 530.2c0 16.7-13.7 30.3-30.6 30.3H355.4c-16.9 0-30.6-13.6-30.6-30.3V382.9h373.6v447.2z" fill="#211F1E" /><path d="M511.6 798.9c11.5 0 20.8-9.3 20.8-20.8V466.8c0-11.5-9.3-20.8-20.8-20.8s-20.8 9.3-20.8 20.8v311.4c0 11.4 9.3 20.7 20.8 20.7zM407.8 798.9c11.5 0 20.8-9.3 20.8-20.8V466.8c0-11.5-9.3-20.8-20.8-20.8s-20.8 9.3-20.8 20.8v311.4c0.1 11.4 9.4 20.7 20.8 20.7zM615.4 799.6c11.5 0 20.8-9.3 20.8-20.8V467.4c0-11.5-9.3-20.8-20.8-20.8s-20.8 9.3-20.8 20.8v311.4c0 11.5 9.3 20.8 20.8 20.8z" fill="#211F1E" /></svg>    
                                        </a>
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

                {{ $interested->links() }}
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
