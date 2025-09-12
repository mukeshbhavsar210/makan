<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Razorpay\Api\Api;
use App\Models\Property;
use App\Models\Plan;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller {

    public function index() {
        $successOrders = Order::with(['property.images', 'plan'])->where('status', 'paid')->latest()->paginate(10, ['*'], 'success_page');
        $failedOrders = Order::with(['property.images', 'plan'])->whereIn('status', ['failed', 'pending'])->latest()->paginate(10, ['*'], 'failed_page');
        $orders = Order::with(['property.images', 'plan'])->get();

        return view('front.admin.orders', compact('successOrders', 'failedOrders', 'orders'));
    }


    public function createPayment(Request $request) {
        $property = Property::findOrFail($request->property_id);
        $plan = Plan::findOrFail($request->plan_id);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Amount in paise
        $amount = $plan->price * 100;

        $razorpayOrder = $api->order->create([
            'receipt' => 'order_' . time(),
            'amount' => $amount,
            'currency' => 'INR'
        ]);

        // Save order in DB
        $order = Order::create([
            'property_id' => $property->id,
            'plan_id' => $plan->id,
            'razorpay_order_id' => $razorpayOrder['id'],
            'amount' => $plan->price,
            'status' => 'pending',
        ]);

        return view('payment.checkout', compact('property', 'plan', 'order', 'razorpayOrder'));
    }



    public function paymentSuccess(Request $request) {
        $request->validate([
            'razorpay_order_id' => 'required',
            'razorpay_payment_id' => 'required',
            'razorpay_signature' => 'required'
        ]);

        $order = Order::where('razorpay_order_id', $request->razorpay_order_id)->firstOrFail();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        try {
            // Verify payment signature
            $api->utility->verifyPaymentSignature($attributes);

            // Update order as paid
            $order->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'status' => 'paid'
            ]);

            // Activate property
            $property = $order->property;
            $property->plan_id = $order->plan_id;
            $property->status = 1;
            $property->start_date = now();
            $property->end_date = now()->addDays($property->plan->duration ?? 30);
            $property->save();

            return response()->json([
                'status' => true,
                'redirect' => route('payment.success.page', ['property' => $property->id])
            ]);

        } catch (\Exception $e) {
            $order->update(['status' => 'failed']);
            return response()->json([
                'status' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ]);
        }
    }

    // Optional: show success page
    public function successPage($propertyId) {
        $property = Property::with('plan')->findOrFail($propertyId);
        return view('front.admin.payment', compact('property'));
    }
}