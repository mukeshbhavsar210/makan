@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <h1>Builders <span class="badge badge-primary">{{ $counts }}</span></h1>
            </div>
            <div class="col-sm-3">
                <button type="button" class="btn btn-primary float-lg-right" data-toggle="modal" data-target="#exampleModalRight">Add Builder</button>
            </div>
        </div>
    </div>
</section>

<section>    
    <div class="container-fluid">
        @include('admin.message')

        <div class="modal fade drawer right-align" id="exampleModalRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Builder</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="" method="post" id="builderForm" name="builderForm">
                            <div class="modal-body">                                    
                                <div class="row"> 
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                            <p></p>
                                        </div>
                                    </div> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="year_estd">Year Estd.</label>
                                            <input type="text" name="year_estd" id="year_estd" class="form-control" placeholder="Year Estd.">
                                            <p></p>
                                        </div>
                                    </div>  
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                            <p></p>
                                        </div>
                                    </div> 
                                    <div class="col-md-12">  
                                        <div class="form-group">
                                            <label>Similar property</label>
                                            <select multiple class="relatedProperty" name="related_properties[]" >

                                            </select>
                                        </div>                    
                                    </div>      
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                            <p></p>
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile">
                                            <p></p>
                                        </div>                                                          
                                    </div>  
                                </div>  
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="whatsapp">Whatsapp</label>
                                            <input type="text" name="whatsapp" id="whatsapp" class="form-control" placeholder="Whatsapp">
                                            <p></p>
                                        </div>
                                   
                                        <div class="form-group">
                                            <label for="landline">Landline</label>
                                            <input type="text" name="landline" id="landline" class="form-control" placeholder="Landeline">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" id="image_id" name="image_id" value=" ">
                                            <label for="image">Logo</label>
                                            <div id="image" class="dropzone dz-clickable">
                                                <div class="dz-message needsclick">
                                                    <br>Drop files here or click to upload.<br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>                                
                            </div>
                            <div class="modal-footer">  
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>                                    
                            </div>                            
                        </form>                        
                    </div>                   
                </div>
        </div>       

       <ul class="nav nav-tabs" id="roleTabs" role="tablist">
            @php $tabIndex = 0; @endphp {{-- separate counter for visible tabs --}}
            @foreach($roles as $index => $role)
                @if(strtolower($role) !== 'admin') {{-- skip admin role --}}
                    <li class="nav-item">
                        <a class="nav-link {{ $tabIndex == 0 ? 'active' : '' }}" 
                        id="role-{{ $index }}-tab" 
                        data-toggle="tab" 
                        href="#role-{{ $index }}" 
                        role="tab">
                            {{ ucfirst($role) }}
                        </a>
                    </li>
                    @php $tabIndex++; @endphp
                @endif
            @endforeach
        </ul>

        <div class="card">
            <form action="" method="get" >
                <div class="card-header">
                    <div class="card-title">
                        <button type="button" onclick="window.location.href='{{ route('builders.index') }}'" class="btn btn-default btn-sm">Reset</button>
                    </div>

                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        
            <div class="tab-content border border-top-0" id="roleTabsContent">
                @foreach($roles as $index => $role)
                    <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" 
                        id="role-{{ $index }}" role="tabpanel" 
                        aria-labelledby="role-{{ $index }}-tab">
                        
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="50">ID</th>
                                    <th>Builder Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tbody>
                                    <div id="accordion{{ $role }}"> {{-- parent wrapper per role --}}
                                        @forelse($propertiesByRole[$role] as $builderId => $properties)
                                            @php
                                                $builder = $properties->first()->builder;
                                            @endphp
                                            <tr>
                                                <td>{{ $builder->id }}</td>
                                                <td>
                                                    <div id="headingBuilder{{ $builder->id }}">
                                                        <a class="collapsed" 
                                                        data-toggle="collapse" 
                                                        href="#collapseBuilder_{{ $builder->id }}" 
                                                        aria-expanded="false" 
                                                        aria-controls="collapseBuilder_{{ $builder->id }}">
                                                            <img style="border-radius:100px; width:35px; height:35px" 
                                                                src="{{ asset('uploads/builder/'.$builder->logo) }}" 
                                                                alt="" />
                                                            <span class="ml-2">{{ $builder->name }}</span>
                                                            <span class="badge badge-primary">{{ $properties->count() }}</span>
                                                        </a>
                                                    </div>

                                                    <div id="collapseBuilder_{{ $builder->id }}" class="collapse" aria-labelledby="headingBuilder{{ $builder->id }}" data-parent="#accordion{{ $role }}">
                                                        <div class="mt-3 mb-3">

                                                            <table class="table table-hover text-nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="130">Picture</th>
                                                                        <th>Project Name</th>
                                                                        <th>Posted by</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($properties as $property)                                                                
                                                                        <tr>  
                                                                            <td>                                                                            
                                                                                @php
                                                                                    $PropertyImage = $property->property_images->first();
                                                                                @endphp  
                                                                                <a href="{{ route('propertyDetails', $property->id) }}" target="_blank">
                                                                                    @if (!empty($PropertyImage->image))
                                                                                        <img src="{{ asset('uploads/property/small/'.$PropertyImage->image) }}" class="img-responsive" />
                                                                                    @else
                                                                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" class="img-responsive" />
                                                                                    @endif
                                                                                </a>
                                                                            </td>                                                    
                                                                            <td>
                                                                                <h5>{{ $property->title }}</h5>
                                                                                @php
                                                                                    $price = $property->price;
                                                                                    $formatted = number_format($price / 100000, 1) . ' L'; 
                                                                                @endphp
                                                                                <span>₹{{ $formatted }}</span><br />
                                                                                {{ $property->area->name }}, {{ $property->city->name }}
                                                                            </td>
                                                                            <td>{{ $property->user->name }}<br />
                                                                                M. {{ $property->user->mobile }} 
                                                                            </td>                                                                            
                                                                            <td>
                                                                                @if($property->status == 1)
                                                                                    <span class="badge badge-success">Approved</span>
                                                                                @else
                                                                                    <span class="badge badge-danger">Inactive</span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </td>                                                
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No builders found for {{ $role }}</td>
                                            </tr>
                                        @endforelse
                                    </div>
                                </tbody>

                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>

            <div class="card-footer clearfix">
                {{ $builders->links() }}
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
     //Similar property
     $('.relatedProperty').select2({
        ajax: {
            url: '{{ route('property.properties') }}',
            dataType: 'json',
            tags: true,
            multiple: true,
            minimumInputLength: 3,
            processResults: function (data) {
                return {
                    results: data.tags
                };
            }
        }
    });

$("#builderForm").submit(function(event){
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route("builders.store") }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $("button[type=submit]").prop('disabled', false);

                    if(response["status"] == true){

                        window.location.href="{{ route('builders.index') }}"

                        $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");

                    } else {
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


    function deleteBuilder(id){

        var url = '{{ route("builders.delete","ID") }}'
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
                        window.location.href="{{ route('builders.index') }}"
                    }
                }
            });
        }
    }


    Dropzone.autoDiscover = false;
            const dropzone = $("#image").dropzone({
                init: function() {
                    this.on('addedfile', function(file) {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }
                    });
                },
                url:  "{{ route('temp-images.create') }}",
                maxFiles: 1,
                paramName: 'image',
                addRemoveLinks: true,
                acceptedFiles: "image/jpeg,image/png,image/gif",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, success: function(file, response){
                    $("#image_id").val(response.image_id);
                    //console.log(response)
                }
            });
</script>
@endsection
