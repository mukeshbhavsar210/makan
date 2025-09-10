@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-12">
                <h1>Property <span class="counts">{{ $counts }}</span></h1>
            </div>
            <div class="col-sm-5 col-12">
                <div class="search-top">
                    <form action="" method="get" class="part">
                        <div class="search-top">
                            <div class="input-group input-group" style="width: 250px;">
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary icon-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                            
                            <button type="button" onclick="window.location.href='{{ route('properties.index') }}'" class="btn icon-btn"><i class="fa-solid fa-arrow-rotate-right"></i></button>
                        </div>
                    </form>

                    <a href="{{ route('properties.create') }}" class="btn btn-primary part">New Property</a>
                </div>
            </div>
        </div>
   
        @include('front.layouts.message')

        <div class="row mt-2">
            @foreach($properties as $property)
                <x-card :data="$property" type="property" />
            @endforeach
        </div>
        <div class="mt-4">
            {{ $properties->links() }}
        </div>
</div>

</section>
@endsection

@section('customJs')

<script>
   
    function deleteProperty(id){
        var url = '{{ route("properties.delete","ID") }}'
        var newUrl = url.replace("ID",id)

        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                success: function(response){
                    if(response["status"]){
                        window.location.href="{{ route('properties.index') }}"
                    } else {
                        window.location.href="{{ route('properties.index') }}"
                    }
                }
            });
        }
    }
</script>
@endsection