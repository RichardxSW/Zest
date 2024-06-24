@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">System Users</h5>
                    <p class="card-text">{{ $userCount }}</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Category</h5>
                    <p class="card-text">{{ $categoryCount }}</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Product</h5>
                    <p class="card-text">{{ $productCount }}</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Customer</h5>
                    <p class="card-text">5</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3 mb-4">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">Supplier</h5>
                    <p class="card-text">2</p>
                    <a href="{{ route('supplier.index') }}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Purchase</h5>
                    <p class="card-text">3</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Outgoing</h5>
                    <p class="card-text">2</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
