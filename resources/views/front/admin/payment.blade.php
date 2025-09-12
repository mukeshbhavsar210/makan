@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">           
       <div class="progress-right">
            <h2>Payment Successful!</h2>
            <a target="_blank" href="{{ $property->url }}" onclick="visitedProperty({{ $property->id }})" class="product-link" target="_blank">
                @if ($property->property_images && $property->property_images->count())
                    @foreach ($property->property_images->whereIn('label', ['Main',]) as $propertyImage)
                        <img src="{{ asset('uploads/property/thumb/'.$propertyImage->image) }}" alt="{{ $propertyImage->label }}" height="200px" width="200px">
                    @endforeach
                @else
                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="Default" height="200px" width="200px">
                @endif                
            </a>  
            <p>Property <strong><a target="_blank" href="{{ $property->url }}" onclick="visitedProperty({{ $property->id }})" class="product-link" target="_blank">{{ $property->title }}</a></strong> is now active.</p>
            <p>You choose: {{ $property->plan->name }} Plan <br />
            Valid until: {{ \Carbon\Carbon::parse($property->end_date)->format('d M, Y') }}</p>
            <a href="{{ route('properties.index') }}" class="btn btn-primary mt-3">Go to My Properties</a>
        </div>
    </div>
@endsection