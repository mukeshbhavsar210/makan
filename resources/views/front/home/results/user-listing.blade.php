@extends('front.layouts.app')

@section('hideHeader') @endsection
@section('main')

@include('front.home.results.header')
{{-- @include('front.home.results.filters') --}}

<div class="body-details">
    <div class="row">
        <div class="col-md-8 col-12">
            {{-- @include('front.home.results.breadcrumb') --}}

            <div class="developer-listings" style="margin-top: 50px;">
                @php
                    $builder = $user->builder ?? null;
                    $imagePath = $builder && !empty($builder->image) ? 'uploads/developer/' . $builder->image : null;
                @endphp

                <div class="logo-wrapper">
                    <div class="logo">
                        @php
                            $builder = $user->builder ?? null;
                            $builderImagePath = $builder && !empty($builder->image) ? 'uploads/developer/' . $builder->image : null;
                            $userImagePath = !empty($user->image) ? 'uploads/profile/' . $user->image : null;
                        @endphp

                        @if ($user->role === 'Builder' && $builder && $builder->image && file_exists(public_path($builderImagePath)))
                            <img src="{{ asset($builderImagePath) }}" alt="{{ $builder->developer_name ?? 'Builder' }}">
                        @elseif ($user->image && file_exists(public_path($userImagePath)))
                            <img src="{{ asset($userImagePath) }}" alt="{{ $user->name ?? 'User' }}" class="user">
                        @else
                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="Default Logo">
                        @endif
                    </div>

                    <div class="name">
                        <h5>{{ $builder->developer_name ?? $user->name ?? 'Unknown' }}</h5>
                        <div class="details">                            
                            @if ($user->role === 'Builder' && $builder && !empty($builder->estd))
                                <div class="text">
                                    <p class="label">Year estd.:</p>
                                    <p class="tiny">{{ $builder->estd }}</p>
                                </div>
                            @endif

                            <div class="text">
                                <p class="label">Projects:</p>
                                <p class="tiny">{{ $propertyCount }}</p>
                            </div>
                        </div>                    
                    </div>
                </div>
                                   
                @php
                    $builderAbout = $builder->about ?? null;                       
                @endphp

                @if ($user->role === 'Builder' && $builderAbout)
                    <div class="about">
                        <p class="short-text">{{ $builderAbout }}</p>
                        <a href="javascript:void(0);" class="read-more">Read More</a>
                    </div>
                @endif
               
            </div>

            @include('front.home.results.cards')

            </div>
            <div class="col-md-4 col-12">Right</div>
        </div>
    </div>
</div>

@endsection

@section('customJs')
<script>
$(document).ready(function(){

    var showChar = 150;  // limit to 150 characters
    var ellipsestext = "...";
    var moretext = "Read More";
    var lesstext = "Read Less";

    $('.about p.short-text').each(function() {
        var content = $(this).text();

        if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="more-ellipses">' + ellipsestext + '&nbsp;</span>'
                     + '<span class="more-content"><span>' + h + '</span>&nbsp;<a href="javascript:void(0);" class="more-link">' 
                     + moretext + '</a></span>';

            $(this).html(html);
        }
    });

    $(".more-content .more-link").click(function(){
        var $this = $(this);
        if($this.hasClass("less")) {
            $this.removeClass("less");
            $this.text(moretext);
        } else {
            $this.addClass("less");
            $this.text(lesstext);
        }
        $this.parent().prev().toggle();  // toggle ellipses
        $this.prev().toggle();            // toggle hidden text
        return false;
    });

});
</script>

</script>
@endsection

