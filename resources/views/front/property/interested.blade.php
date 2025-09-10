@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-12">
                <h1>Interested <span class="counts">{{ $counts }}</span></h1>
            </div>
            <div class="col-sm-5 col-12">
                <form action="" method="get" class="part">
                    <div class="search-top">
                        <div class="input-group input-group" style="width: 250px;">
                            <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary icon-btn"><i class="iconoir-search"></i></button>
                            </div>
                        </div>
                        
                        <button type="button" onclick="window.location.href='{{ route('account.myPropertyApplications') }}'" class="btn icon-btn"><i class="las la-undo-alt"></i></button>
                    </div>
                </form>
            </div>               
        </div>
  
        @include('front.layouts.message')

        <div class="row mt-2">
            @foreach($interested as $int)
                <x-card :data="$int" type="interested" />
            @endforeach
        </div>

        <div class="mt-4">
            {{ $interested->links() }}
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
