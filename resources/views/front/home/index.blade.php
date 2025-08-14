@extends('front.layouts.app')

@section('main')

<div class="container">
    <section class="searchHome">
        <div class="mainTitle">
            <h1>Trusted place to find a home</h1>
            <p>9K+ listings added daily and 64K+ total verified</p>
        </div>
       
        <div class="search-engine">
            <form action="{{ route('properties') }}" >            
                <ul class="rentBuy">
                    @if ($categories)                               
                        @foreach ($categories as $value)
                            <li>
                                <label class="{{ request('category') == $value->id || (!request('category') && $loop->first) ? 'activeTab' : '' }}">
                                    <input type="radio" name="category" value="{{ $value->id }}"
                                        {{ request('category') == $value->id || (!request('category') && $loop->first) ? 'checked' : '' }}>
                                    {{ $value->name }}
                                </label>
                            </li>
                        @endforeach                            
                    @endif
                </ul>

                <div class="search-controls">
                    <div class="flex-search">
                        <select name="city" id="city" class="city">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ Request::get('city') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>           

                        <div id="search-container" style="display:none;">
                            <input value="{{ Request::get('keyword') }}" type="text" name="keyword" id="keyword" placeholder="Search for locality, landmark, project or builder" class="form-control">

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

	
  {{-- 
		@include('front.home.properties')
		
        <section class="elementor-section elementor-top-section elementor-element elementor-element-2ae8c1a4 elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default">
            <div class="elementor-background-overlay"></div>
            <div class="elementor-container elementor-column-gap-no">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-422e2dff">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-6acb05bb elementor-section-content-middle elementor-section-full_width elementor-section-height-default elementor-section-height-default">
                            <div class="elementor-container elementor-column-gap-no">
                                <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-3136eafb">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div class="elementor-element elementor-element-2826d4eb elementor-widget elementor-widget-heading">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">Finding a perfect property</h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-e17f7a elementor-widget elementor-widget-heading">
                                            <div class="elementor-widget-container">
                                                <p class="elementor-heading-title elementor-size-default">You can find perfectly suited properties for your all needs with ease.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>				
                    </div>
                </div>
            </div>
        </section>

		<section class="elementor-section">
            <h2>Meet Our Developers</h2>
            <span class="elementor-button-text">View All</span>                  
        </section>

        <div class="meetDeveloprs">
            <div class="rhea-ultra-agent-slide-outer">
                <div class="rhea-ultra-agent-slide">
                    <div class="rhea-ultra-agent-thumb-detail">
                        <div class="rhea-agent-thumb">
                        <a href="https://ultra.realhomes.io/agent/alice-brian/">
                        <img loading="lazy" decoding="async" width="210" height="210" src="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/05/Alice-Brian-1-210x210.jpg" class="attachment-agent-image size-agent-image wp-post-image" alt="" srcset="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/05/Alice-Brian-1-210x210.jpg 210w, https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/05/Alice-Brian-1-300x300.jpg 300w, https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/05/Alice-Brian-1-150x150.jpg 150w, https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/05/Alice-Brian-1.jpg 534w" sizes="(max-width: 210px) 100vw, 210px">                                            </a>
                        </div>
                        <div class="rhea-agent-detail">
                        <h3>
                            <a href="https://ultra.realhomes.io/agent/alice-brian/">Alice Brian</a>
                            <span class="rh_agent_verification__icon">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="405.272px" height="405.272px" viewBox="0 0 405.272 405.272" xml:space="preserve">
                                    <path d="M393.401,124.425L179.603,338.208c-15.832,15.835-41.514,15.835-57.361,0L11.878,227.836
                                    c-15.838-15.835-15.838-41.52,0-57.358c15.841-15.841,41.521-15.841,57.355-0.006l81.698,81.699L336.037,67.064
                                    c15.841-15.841,41.523-15.829,57.358,0C409.23,82.902,409.23,108.578,393.401,124.425z"></path>
                                </svg>
                            </span>
                        </h3>
                        <a class="rhea-ultra-agent-title" href="https://ultra.realhomes.io/agency-detail/alice-estate-agency/">
                        Alice Estate Agency                                                </a>
                        </div>
                    </div>
                    <div class="rhea-ultra-agent-listings-thumbs">
                        <img decoding="async" src="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2022/11/living-room-gbb61c6983_1920-300x198.jpg" alt="living-room-gbb61c6983_1920.jpg">
                        <img decoding="async" src="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2022/11/spacejoy-4xRP0Ajk9ys-unsplash-300x169.jpg" alt="spacejoy-4xRP0Ajk9ys-unsplash.jpg">
                        <img decoding="async" src="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2022/11/collov-home-design-i78VpqDGDSc-unsplash-300x225.jpg" alt="collov-home-design-i78VpqDGDSc-unsplash.jpg">
                    </div>
                    <div class="rhea-ultra-agent-links">
                        <a class="rhea-ultra-agent-profile" href="">View Profile</a>
                        <a class="rhea-ultra-agent-listed" href="">3 Listed Properties<i class="rhea-fas fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
            <div>2</div>
            <div>3</div>
            <div>4</div>
            <div>5</div>
            <div>6</div>
        </div>
		
        @include('front.home.discoverPropeties')		 --}}

@endsection
@section('customJs')

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
</script>