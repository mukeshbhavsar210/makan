@extends('front.layouts.app')

@section('main')

<section class="searchHome">
    <div class="container">    
        <div class="mainTitle">
            <h1>Trusted place to find a home</h1>
            <p>9K+ listings added daily and 64K+ total verified</p>
        </div>
       
        <div class="search-engine">
            <form action="{{ route('properties.index') }}" method="GET">
                <ul class="rentBuy">
                    @php
                        $categories = ['buy', 'rent'];
                    @endphp
                    @foreach ($categories as $value)
                        <li>
                            <label class="{{ request('category') == $value || (!request('category') && $loop->first) ? 'activeTab' : '' }}">
                                <input type="radio" name="category" value="{{ $value }}" {{ request('category') == $value || (!request('category') && $loop->first) ? 'checked' : '' }}>{{ $value }}
                            </label> 
                        </li>
                    @endforeach
                </ul>

                <div class="search-controls">
                    <div class="flex-search">
                        <select name="city" id="city" class="city">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" data-slug="{{ $city->slug }}" {{ Request::get('city') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>           

                        <div id="search-container" style="display:none;">
                            <input value="{{ Request::get('keyword') }}" type="text" name="keyword" id="keyword" 
                                placeholder="Search for locality, landmark, project or builder" class="form-control">
                            <ul id="areas" class="areas-list" style="display:none;">
                                <li>Popular search in </li>
                            </ul>
                        </div>
                    </div>

                    <div class="right-btn">
                        <button class="btn btn-primary" type="submit">Search</button>      
                    </div>
                </div>          
            </form>
        </div>
    </section>
</div>
		
<div class="container">
    <h2>Finding a perfect property</h2>
    <p>You can find perfectly suited properties for your all needs with ease.</p>

    <section class="elementor-section">
        <h2>Meet Our Developers</h2>
        <span class="elementor-button-text">View All</span>                  
    </section>

    <div class="meetDeveloprs">
        <div>1</div>
        <div>2</div>
        <div>3</div>
        <div>4</div>
        <div>5</div>
        <div>6</div>
    </div>
</div>

@endsection
@section('customJs')
{{-- 
<script type="text/javascript">
    function interested(id){
        $.ajax({
            url: '{{ route("applyProperty") }}',
            type: 'post',
            data: {id:id},
            dataType: 'json',
            success: function(response){
                window.location.href = "{{ url()->current() }}";
            }
        });
    }

    function saveProperty(id){
        $.ajax({
            url: '{{ route("saveProperty") }}',
            type: 'post',
            data: {id:id},
            dataType: 'json',
            success: function(response){
                window.location.href = "{{ url()->current() }}";
            }
        });
    }   
</script> --}}