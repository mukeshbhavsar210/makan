@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">      
        <h4 class="mb-4">Orders</h4>
        <nav>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Placed Orders - ({{ $successOrders->total() }})</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Failed Orders - ({{ $failedOrders->total() }})</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Property</th>
                            <th>Name, Plan and Amount</th>
                            <th>Payment ID</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($successOrders as $order)
                            <tr>
                                <td style="width: 50px;">{{ $order->id }}</td>
                                <td style="width: 80px;">
                                    @php
                                        $PropertyImage = $order->property?->images?->first();
                                    @endphp
                                    <a href="{{ $order->property->url ?? '#' }}" target="_blank" class="product-link">
                                        @if ($PropertyImage)
                                            <img src="{{ asset('uploads/property/thumb/'.$PropertyImage->image) }}" 
                                                height="80" width="80" class="me-2 align-self-center rounded">
                                        @else
                                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" 
                                                alt="" height="80" class="me-2 align-self-center rounded">
                                        @endif
                                    </a>                                       
                                </td>
                                <td>
                                    <h5 class="m-0 mt-3">{{ $order->property->title ?? 'N/A' }}</h5>
                                    <p>{{ $order->plan->name ?? 'N/A' }}<br />₹{{ $order->amount }}</p>
                                </td>
                                <td>{{ $order->razorpay_payment_id }}</td>
                                <td>{{ $order->created_at->format('d M, Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">No successful orders found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $successOrders->links() }}
            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Property</th>
                            <th>Name, Plan and Amount</th>
                            <th>Status</th>
                            <th>Payment ID</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($failedOrders as $order)
                            <tr>
                                <td style="width: 50px;">{{ $order->id }}</td>
                                <td style="width: 80px;">
                                    @php
                                        $PropertyImage = $order->property?->images?->first();
                                    @endphp
                                    <a href="{{ $order->property->url ?? '#' }}" target="_blank" class="product-link">
                                        @if ($PropertyImage)
                                            <img src="{{ asset('uploads/property/thumb/'.$PropertyImage->image) }}" 
                                                height="80" width="80" class="me-2 align-self-center rounded">
                                        @else
                                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" 
                                                alt="" height="80" class="me-2 align-self-center rounded">
                                        @endif
                                    </a>                                       
                                </td>
                                <td>
                                    <h5 class="m-0 mt-3">{{ $order->property->title ?? 'N/A' }}</h5>
                                    <p>{{ $order->plan->name ?? 'N/A' }}<br />₹{{ $order->amount }}</p>
                                </td>
                                <td><span class="badge bg-danger">{{ ucfirst($order->status) }}</span></td>
                                <td>{{ $order->razorpay_order_id }}</td>
                                <td>{{ $order->created_at->format('d M, Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">No failed or pending orders found</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $failedOrders->links() }}
            </div>
        </div>
</div>
@endsection
