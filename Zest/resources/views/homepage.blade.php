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
                    <h5 class="card-title">{{ $userCount }}</h5>
                    <p class="card-text"> System Users </p>
                        <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">{{ $categoryCount }}</h5>
                    <p class="card-text">Category</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">{{ $productCount }}</h5>
                    <p class="card-text">Product</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">{{ $customerCount }}</h5>
                    <p class="card-text">Customer</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3 mb-4">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">{{ $supplierCount }}</h5>
                    <p class="card-text">Supplier</p>
                    <a href="{{ route('supplier.index') }}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">3</h5>
                    <p class="card-text">Total Purchase</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">2</h5>
                    <p class="card-text">Total Outgoing</p>
                    <a href="#" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Highest Selling Products
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Total Sold</th>
                                <th>Total Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <tr>
                                    <td>title</td>
                                    <td>total_sold</td>
                                    <td>total_quantity</td>
                                </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Low Quantity Products
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowQuantityProducts as $product)
                                <tr>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>{{ $product->harga_produk }}</td>
                                    <td>{{ $product->jumlah_produk }}</td>
                                    <td>{{ $product->kategori_produk }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Latest Sales
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Date</th>
                                <th>Total Sale</th>
                            </tr>
                        </thead>
                        <tbody>
                     
                                <tr>
                                    <td> iteration </td>
                                    <td> product_name </td>
                                    <td> date </td>
                                    <td> total_sale </td>
                                </tr>
                   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Recently Added Products
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentlyAddedProducts as $product)
                                <tr>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>{{ $product->harga_produk }}</td>
                                    <td>{{ $product->jumlah_produk }}</td>
                                    <td>{{ $product->kategori_produk }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
