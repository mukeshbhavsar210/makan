<form action="{{ route('properties') }}" >                            
    <div class="search-strip">
        <ul id="areas_top" >
            @if(Request::get('city'))
                @php
                    $areas = \App\Models\Area::where('city_id', Request::get('city'))->get();
                    $selectedAreas = (array) Request::get('area'); // multiple areas allowed
                @endphp
                @php
                    $firstAreaId = $selectedAreas ? $selectedAreas[0] : ($areas[0]->id ?? null);
                @endphp
                <li class="search-icon">                    
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.6725 16.6412L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </li>
                @if($firstAreaId)
                    @php $firstArea = $areas->firstWhere('id', $firstAreaId); @endphp
                    @if($firstArea)
                        <li>
                            <label class="custom-checkbox-label">
                                <input type="checkbox" name="area" value="{{ $firstArea->id }}" checked>
                                {{ $firstArea->name }}                                
                            </label>
                        </li>
                    @endif
                @endif
                @php
                    $selectedUnique = collect($selectedAreas)->unique();
                    $selectedCount = $selectedUnique->count();
                    $extraCount = max(0, $selectedCount - 1);
                @endphp

                @if($areas->count() > 1)                    
                    <li>
                        <a href="javascript:void(0);" id="showAllAreasTop" class="show-all"> 
                            @if($extraCount > 0)
                                <svg fill="#0d6efd" width="16px" height="16px" viewBox="-3 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                    <path d="M12.711 9.182a1.03 1.03 0 0 1-1.03 1.03H7.53v4.152a1.03 1.03 0 0 1-2.058 0v-4.152H1.318a1.03 1.03 0 1 1 0-2.059h4.153V4.001a1.03 1.03 0 0 1 2.058 0v4.152h4.153a1.03 1.03 0 0 1 1.029 1.03z"/>
                                </svg>
                                {{ $extraCount }} more
                            @else
                                <svg fill="#0d6efd" width="16px" height="16px" viewBox="-3 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                    <path d="M12.711 9.182a1.03 1.03 0 0 1-1.03 1.03H7.53v4.152a1.03 1.03 0 0 1-2.058 0v-4.152H1.318a1.03 1.03 0 1 1 0-2.059h4.153V4.001a1.03 1.03 0 0 1 2.058 0v4.152h4.153a1.03 1.03 0 0 1 1.029 1.03z"/>
                                </svg>
                                Add
                            @endif
                        </a>
                    </li>                    
                @endif
            @endif
        </ul>

        <div class="hidden-areas-added-top">
            @php $rendered = []; @endphp

            @php 
                $rendered = [];
                $selectedUnique = collect($selectedAreas)->unique();
            @endphp

            <div class="listing-areas-top" style="display: none" >
                <ul class="added-top" style="{{ $selectedUnique->count() > 1 ? '' : 'display:none;' }}">                    
                    @foreach($selectedAreas as $index => $areaId)
                        @if($areaId != $firstAreaId && !in_array($areaId, $rendered))
                            @php 
                                $area = $areas->firstWhere('id', $areaId); 
                                $rendered[] = $areaId;
                            @endphp
                            @if($area)
                                <li class="area-item">
                                    <label class="custom-checkbox-label">
                                        <input type="checkbox" name="area[]" value="{{ $area->id }}" checked> 
                                        {{ $area->name }}
                                        <a href="javascript:void(0);" class="remove-area" data-id="{{ $area->id }}">
                                            <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                                <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"/>
                                            </svg>
                                        </a>
                                    </label>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>

                <ul class="add-more-areas">
                    <li class="popular">Popular</li>
                    @foreach($areas as $index => $area)
                        @if(!in_array($area->id, $selectedAreas) && !(!$selectedAreas && $index == 0))
                            <li class="top">
                                <label class="custom-checkbox-label top">
                                    <input type="checkbox" name="area[]" value="{{ $area->id }}">{{ $area->name }}
                                </label>
                            </li>
                        @endif
                    @endforeach  
                </ul>
            </div>
        </div>                     
    </div>
</form> 