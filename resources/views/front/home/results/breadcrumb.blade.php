<div class="container-fluid">        
    <ul class="breadcrumb">
        <li><a href="{{ route('front.home') }}">Home</a></li>                
        @php
            $category = request()->get('category'); // keep current category
        @endphp

        @if($citySelected)
            <li><a href="{{ url('/properties') }}?category={{ $category }}&city={{ $citySelected->slug }}">{{ $citySelected->name }}</a></li>
        @endif

        @php
            $areas = $area instanceof \Illuminate\Support\Collection ? $area : collect([$area]);
        @endphp

        @if($areas->count())            
            @if($areaSelected)
                <li class="active" aria-current="page">{{ $areaSelected->name }}</li>
            @endif              
        @endif
    </ul>

    <div class="search-counts">
        @if($properties->total() > 0)
            <div class="results-count">
                Showing {{ $properties->firstItem() }} - {{ $properties->lastItem() }} of {{ $properties->total() }}
            </div>
        @endif
    </div>

    <div class="page-title">
        @php
            $areas = $area instanceof \Illuminate\Support\Collection ? $area : collect([$area]);
        @endphp
        <h5>
            @if($areas->count())
                Flat 
                @php
                    $category = ucfirst(request()->get('category', 'buy')); 
                @endphp
                @if($category)
                    {{ $category }}
                @endif
                in 
                @if($areaSelected)
                    {{ $areaSelected->name }},    
                @endif
                 {{-- {{ $citySelected->name }} --}}
            @endif
        </h5>
        <div class="css-7b7t20">Sort by:<div class="input-container-dropdown css-1bh13te"><div class="input-container"><div class="css-gg4vpm"><div>Relevance</div><span class="css-5m6l3y"></span></div></div></div></div>
    </div>
</div>