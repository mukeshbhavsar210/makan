<section class="searchHome">
    <h1>Properties to buy in Bengaluru</h1>
    <nav>
        <div class="nav nav-tabs" >
            <a href="{{ route('front.home') }}" class="nav-link active">Buy</a>
            <a href="{{ route('front.rent') }}" class="nav-link">Rent</a>
        </div>
    </nav>

    <div class="shadow p-4">
        <form action="{{ route('properties') }}" >            
            <ul class="rhea-ultra-tabs-list">
                @if ($categories)                               
                    @foreach ($categories as $value)
                        <li class="rhea-ultra-tab">
                            <label class="rh-ultra-search-field-label tab-for-rent">
                                <input type="radio" name="category" value="{{ $value->id }}" {{ request('category') == $value->id ? 'checked' : '' }} >
                                <span class="rhea-ultra-tab-name">{{ $value->name }}</span>                                            
                            </label>
                        </li>
                    @endforeach                            
                @endif
            </ul>        

            {{-- <select name="category" id="category" >
            <option value="">All</option>
            @if ($categories)
                @foreach ($categories as $value)
                    <option {{ (Request::get('category') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            @endif
            </select> --}}
        
            <select name="city" id="city" >
                <option value="">City</option>
                @if ($cities)
                    @foreach ($cities as $value)
                        <option {{ (Request::get('city') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}" class="form-control">{{ $value->name }}</option>
                    @endforeach
                @endif
            </select>
        
            <select name="type" id="type" >
                <option value="">Types</option>
                @if ($types)
                    @foreach ($types as $value)
                        <option {{ (Request::get('type') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                @endif
            </select>
        
            <select name="bathroom" id="bathroom" >
                <option value="">bathroom</option>
                @if ($bathrooms)
                    @foreach ($bathrooms as $value)
                        <option {{ (Request::get('bathroom') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->title }}</option>
                    @endforeach
                @endif
            </select>
            
            <select name="room" id="room" >
                <option value="">Rooms</option>
                @if ($rooms)
                    @foreach ($rooms as $value)
                        <option {{ (Request::get('room') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->title }}</option>
                    @endforeach
                @endif
            </select>
            <button class="btn btn-primary" type="submit">Search</button>                
        </form>
    </div>
</section>


