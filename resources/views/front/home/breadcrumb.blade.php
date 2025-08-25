<div class="container-fluid">        
    <ul class="breadcrumb">
        <li><a href="{{ route('front.home') }}">Home</a></li>                
        @if($citySelected)
            <li><a href="{{ url('/properties?city='.$citySelected->id) }}">{{ $citySelected->name }}</a></li>
        @endif
        {{-- @if($areaSelected)
            <li><a href="{{ url('/properties?city='.$areaSelected->id) }}">{{ $areaSelected->name }}</a></li>
        @endif --}}

        {{-- @php
            $areas = $area instanceof \Illuminate\Support\Collection ? $area : collect([$area]);
        @endphp

        @if($areas->count())
            <li class="active" aria-current="page"> 
                
                Flat 
                @if($categoryWord)
                    {{ $categoryWord }} 
                @endif
                in 
                @foreach($areas as $a)
                    {{ $a->name }}@if(!$loop->last), @endif
                @endforeach
            </li>
        @endif --}}
    </ul>

    <div class="search-counts">
        @if($properties->total() > 0)
            <div class="results-count">
                Showing {{ $properties->firstItem() }} - {{ $properties->lastItem() }} of {{ $properties->total() }}
            </div>
        @endif
    </div>

    <div class="page-title">
        {{-- @php
            $areas = $area instanceof \Illuminate\Support\Collection ? $area : collect([$area]);
        @endphp
        <h5>
            @if($areas->count())
               
                Flat 
                @if($categoryWord)
                    {{ $categoryWord }} 
                @endif
                in 
                @foreach($areas as $a)
                    {{ $a->name }}@if(!$loop->last), @endif
                @endforeach
            @endif
        </h5> --}}

        <div class="css-7b7t20">Sort by:<div class="input-container-dropdown css-1bh13te"><div class="input-container"><div class="css-gg4vpm"><div>Relevance</div><span class="css-5m6l3y"></span></div></div></div></div>
    </div>
</div>