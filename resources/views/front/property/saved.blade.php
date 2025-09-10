@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>Saved Properties <span class="badge rounded text-blue bg-blue-subtle">{{ $counts }}</span></h1>
            </div>  
            <div class="col-sm-6">
                <form action="" method="get" class="part">
                    <div class="search-top">
                        <div class="input-group input-group" style="width: 250px;">
                            <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary icon-btn"><i class="iconoir-search"></i></button>
                            </div>
                        </div>
                        
                        <button type="button" onclick="window.location.href='{{ route('property.savedProperties') }}'" class="btn icon-btn"><i class="las la-undo-alt"></i></button>
                    </div>
                </form>
            </div>                       
        </div>

        @include('front.layouts.message')

        <div class="row mt-2">
            @foreach($savedProperties as $con)
                <x-card :data="$con" type="contacted" />
            @endforeach
        </div>

        <div class="mt-4">
             {{-- {{ $savedProperties->links() }} --}}
        </div>        
    </div>
</section>
@endsection

@section('customJs')
<script type="text/javascript">
    function removeProperty(id){
        if(confirm("Are you sure you want to remove?")){
                $.ajax({
                url: '{{ route("account.removeSavedProperty") }}',
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
