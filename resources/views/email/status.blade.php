@component('mail::message')
# Order Update

Hi {{ $order->user->first_name }} {{ $order->user->last_name }},
Your order **#{{ $order->id }}** has been updated to:
## **{{ ucfirst($order->status) }}**

@if($order->status == 'shipped')
    You can track your order using the button below:
    @component('mail::button', ['url' => url('/account/order/track/' . $order->id)])
        Track Your Order
    @endcomponent
@endif


<table width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f3f3f3;">
            <th align="left">Image</th>
            <th align="left">Product</th>
            <th align="center">Qty</th>
            <th align="right">Price</th>
            <th align="right">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
        <tr style="border-bottom: 1px solid #ddd;">
            <td>
                @if($item->product && $item->product->images->first())
                    <img src="{{ asset('uploads/products/small/' . $item->product->images->first()->image1) }}" 
                         alt="Product Image" 
                         width="60" 
                         style="border-radius: 4px;">
                @endif
            </td>
            <td>{{ $item->product->name ?? 'Product' }}</td>
            <td align="center">{{ $item->qty }}</td>
            <td align="right">₹{{ number_format($item->price, 2) }}</td>
            <td align="right">₹{{ number_format($item->price * $item->qty, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@php
    $subtotal = $order->items->sum(function ($item) {
        return $item->price * $item->qty;
    });
    $shipping = $order->shipping_cost ?? 0;
    $total = $subtotal + $shipping;
@endphp

<table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">
    <tbody>
        <tr>
            <td align="right"><strong>Subtotal:</strong></td>
            <td align="right">₹{{ number_format($subtotal, 2) }}</td>
        </tr>
        <tr>
            <td align="right"><strong>Shipping:</strong></td>
            <td align="right">₹{{ number_format($shipping, 2) }}</td>
        </tr>
        <tr style="border-top: 1px solid #ccc;">
            <td align="right"><strong>Total:</strong></td>
            <td align="right"><strong>₹{{ number_format($total, 2) }}</strong></td>
        </tr>
    </tbody>
</table>

{{ config('app.name') }}
@endcomponent