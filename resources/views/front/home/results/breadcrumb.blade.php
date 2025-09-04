<div class="container-fluid">        
    <ul class="breadcrumb">
        <li><a href="{{ route('front.home') }}">Home</a></li>                
        @php
            $category = request()->get('category');
            $property_types = request()->get('property_types');
        @endphp

        @if($citySelected)
            <li><a href="{{ url('/properties') }}?category={{ $category }}&city={{ $citySelected->slug }}">{{ $citySelected->name }}</a></li>
        @endif

        @php
            $areas = $area instanceof \Illuminate\Support\Collection ? $area : collect([$area]);
        @endphp

        @if($areaSelected)
            <li class="active" aria-current="page">{{ $areaSelected->name }}</li>
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
        <h5>
            Flat 
            @php
                $category = ucfirst(request()->get('category', 'buy')); 
            @endphp

            @if ($category == 'buy')
                <span class="rh-ultra-featured">Rent</span>
            @else
                <span class="rh-ultra-hot">Sale</span>
            @endif
            
            in 
            @if($areaSelected)
                {{ $areaSelected->name }},    
            @endif
                {{ $citySelected->name }}
        </h5>
        <div class="css-7b7t20">Sort by:<div class="input-container-dropdown css-1bh13te"><div class="input-container"><div class="css-gg4vpm"><div>Relevance</div><span class="css-5m6l3y"></span></div></div></div></div>
    </div>
</div>