<div class="inner-header">
            <div class="search-engine">
                <form action="{{ route('properties') }}" >            
                    <ul class="rentBuy">
                        <li>I'm looking to</li>

                        @php
                            $categories = [
                                ['id' => 1, 'title' => 'Buy'],
                                ['id' => 2, 'title' => 'Rent'],
                            ];
                        @endphp

                        @foreach ($categories as $value)
                            <li>
                                <label class="dropdown-item custom-radio-label {{ request('category') == $value['id'] ? 'active' : '' }}">
                                    <input type="radio" name="category" value="{{ $value['id'] }}" data-label="{{ $value['title'] }}"
                                        {{ request('category') == $value['id'] ? 'checked' : '' }}>
                                    <span class="radiomark"></span>
                                    {{ $value['title'] }}
                                </label>
                            </li>
                        @endforeach
                    </ul>

                    <div class="search-controls">                        
                        <div class="left">
                            <select name="city" id="city_inner" class="city">
                                <option value="">Select City</option>
                                @foreach ($cities as $c)
                                    <option value="{{ $c->id }}" {{ Request::get('city') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>    
                        </div>
                        <div class="right">
                            <ul id="areas_btm" >
                                @if(Request::get('city'))
                                    @php
                                        $areas = \App\Models\Area::where('city_id', Request::get('city'))->get();
                                        $selectedAreas = (array) Request::get('area'); // multiple areas allowed
                                    @endphp

                                    @php
                                        $firstAreaId = $selectedAreas ? $selectedAreas[0] : ($areas[0]->id ?? null);
                                    @endphp

                                    {{-- Show only the first area --}}
                                    @if($firstAreaId)
                                        @php $firstArea = $areas->firstWhere('id', $firstAreaId); @endphp
                                        @if($firstArea)
                                            <li>
                                                <label class="custom-checkbox-label">
                                                    <input type="checkbox" name="area[]" value="{{ $firstArea->id }}" checked>
                                                    {{ $firstArea->name }}
                                                    <a href="javascript:void(0);" class="remove-area" data-id="{{ $firstArea->id }}">
                                                        <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"/></svg>
                                                    </a>
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
                                            <a href="javascript:void(0);" id="showAllAreasBtm" class="show-all"> 
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

                            {{-- <div class="hidden-areas-added-btm">
                                @php $rendered = []; @endphp

                                @php 
                                    $rendered = [];
                                    $selectedUnique = collect($selectedAreas)->unique();
                                @endphp

                                 <ul class="added-btm" style="{{ $selectedUnique->count() > 1 ? '' : 'display:none;' }}">                    
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

                                <div class="listing-areas-btm" style="display:none;">
                                    <ul id="area_old">
                                        @foreach($areas as $index => $area)
                                            @if(!in_array($area->id, $selectedAreas) && !(!$selectedAreas && $index == 0))
                                                <li>
                                                    <label class="custom-checkbox-label">
                                                        <input type="checkbox" name="area[]" value="{{ $area->id }}">{{ $area->name }}                                                        
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    
                                    <ul id="areas_dynamic" >
                                    </ul>
                                </div>
                            </div> --}}
                        </div>                        

                        <div class="right-btn">
                            <button class="btn btn-primary" type="submit">Search</button>      
                        </div>
                    </div>
                </form>
            </div>
        </div>