@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-12">
                <h1>Contacted <span class="counts">{{ $counts }}</span></h1>
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

        @auth
            <div class="view-controls">
                <span class="view-label">Card</span>
                <label class="switch">
                    <input type="checkbox" class="toggle-view" data-id="{{ auth()->id() }}" {{ (auth()->user()->preferred_view ?? 'card') === 'table' ? 'checked' : '' }} >
                    <span class="slider round"></span>
                </label>
                <span class="view-label">Table</span>
            </div>
        @endauth

        <div id="cardView" class="{{ $viewType === 'table' ? 'd-none' : '' }}">
            @if($interested->isNotEmpty())
                <div class="row mt-2">
                    @foreach($interested as $int)
                        <x-card :data="$int" type="interested" />
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $interested->links() }}
                </div>
            @else
                <div class="card mt-3">
                    <div class="card-body">
                        <h6>Not interested property yet.</h6>
                        <a href="{{ route('front.home') }}" class="btn btn-primary">Search Property</a>
                    </div>
                </div>
            @endif 
        </div>

        <div id="tableView" class="{{ $viewType === 'card' ? 'd-none' : '' }}">
            <div class="table-responsive browser_users">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th class="border-top-0">Photos</th>
                            <th class="border-top-0">Project Name</th>                    
                            <th class="border-top-0">Price</th>
                            @if(Auth::user()->role == 'Admin')
                                <th class="border-top-0">Developer</th>
                            @endif
                            <th class="border-top-0">Interested</th>
                            <th class="border-top-0">Saved</th>
                            <th class="border-top-0">Posted</th>                            
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        @if($interested->isNotEmpty())
                            @foreach($interested as $int)
                                <x-table :data="$int" type="interested" />
                            @endforeach                            
                        <div class="mt-4">
                            {{ $interested->links() }}
                        </div>                        
                        @else                
                            <h6>Not posted property yet.</h6>
                            <a href="{{ route('properties.create') }}" class="btn btn-primary">Post Property</a>                
                        @endif 
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script type="text/javascript">
    $(document).on('change', '.toggle-view', function () {
        let userId = $(this).data('id');
        $.ajax({
            url: "{{ route('properties.toggleView', '') }}/" + userId,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                if(response.status){
                    console.log("Updated view to: " + response.newView);
                    // Optional: reload to apply the new view immediately
                    location.reload();
                }
            },
            error: function(xhr){
                console.error("AJAX Error:", xhr.responseText);
            }
        });
    });

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
