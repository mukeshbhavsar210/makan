@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">           
       <div class="progress-right">
            <h3>Payment Successful!</h3>
            <a target="_blank" href="{{ $property->url }}" onclick="visitedProperty({{ $property->id }})" class="product-link" target="_blank">
                @if ($property->property_images && $property->property_images->count())
                    @foreach ($property->property_images->whereIn('label', ['Main',]) as $propertyImage)
                        <img src="{{ asset('uploads/property/thumb/'.$propertyImage->image) }}" alt="{{ $propertyImage->label }}" height="200px" width="200px">
                    @endforeach
                @else
                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="Default" height="200px" width="200px">
                @endif                
            </a>  
            <p>You successfully your posted Property with {{ $property->plan->name }} Plan <br />
                <strong><a target="_blank" href="{{ $property->url }}" onclick="visitedProperty({{ $property->id }})" class="product-link" target="_blank">{{ $property->title }}</a></strong> in under verification and it will visible in 2-3 hours.</p>
            
            {{-- Valid until: {{ \Carbon\Carbon::parse($property->end_date)->format('d M, Y') }}</p> --}}
            <a href="{{ route('properties.index') }}" class="btn btn-primary default-btn mt-1">My Properties</a>
        </div>
    </div>
@endsection