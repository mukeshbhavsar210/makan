@extends('admin.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container-fluid">       
        <div class="row">
            <div class="col-lg-3">
                @include('admin.layouts.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <h2>Welcome Admin</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
@endsection
