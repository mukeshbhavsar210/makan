@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">

                @include('admin.layouts.message')

                <div class="card border-0 shadow mb-4">

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
@endsection
