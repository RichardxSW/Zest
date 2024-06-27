@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<style>
    .toast {
    background-color: #dc3545; /* Warna latar belakang merah */
    color: white; 
}

.toast .toast-header {
    background-color: #c82333; /* Warna header toast */
    color:white;
}

.toast .toast-body {
    background-color: #dc3545;
   /* Warna teks dalam badan toast */
   color:white;
}

</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 1111">
        <!-- Toast -->
        <div class="toast low-quantity-toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Low Quantity Products Alert</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Some products have low quantity.
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h5 class="card-title">{{ $userCount }}</h5>
                        <p class="card-text">System Users</p>
                        <a href="{{ route('users.index') }}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <i class="fas fa-users fa-4x" style="opacity: 0.35;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h5 class="card-title">{{ $categoryCount }}</h5>
                        <p class="card-text">Category</p>
                        <a href="{{ route('categories.index') }}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <i class="fas fa-tags fa-4x" style="opacity: 0.35;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h5 class="card-title">{{ $productCount }}</h5>
                        <p class="card-text">Product</p>
                        <a href="{{ route('products.index') }}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <i class="fas fa-boxes fa-4x" style="opacity: 0.35;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h5 class="card-title">{{ $customerCount }}</h5>
                        <p class="card-text">Customer</p>
                        <a href="{{ route('customers.index') }}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <i class="fas fa-user fa-4x" style="opacity: 0.35;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3 mb-4">
            <div class="card bg-secondary text-white">
                <div class="card-body d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h5 class="card-title">{{ $supplierCount }}</h5>
                        <p class="card-text">Supplier</p>
                        <a href="{{ route('supplier.index') }}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <i class="fas fa-truck fa-4x" style="opacity: 0.35;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h5 class="card-title">{{ $purchaseCount }}</h5>
                        <p class="card-text">Total Purchase</p>
                        <a href="{{ route('totalpurchase.index') }}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <i class="fas fa-shopping-cart fa-4x" style="opacity: 0.35;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center position-relative">
                    <div>
                        <h5 class="card-title">{{ $saleCount }}</h5>
                        <p class="card-text">Total Sale</p>
                        <a href="{{ route('sellings.index') }}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <i class="fas fa-shipping-fast fa-4x" style="opacity: 0.35;"></i>
                </div>
            </div>
        </div>
    </div>              

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Highest Selling Products</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Total Sold</th>
                                <th>Total Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($highestTotalSale as $pro)
                                @if ($pro->total_sales > 0)
                                <tr>
                                    <td>{{ $pro->nama_produk }}</td>
                                    <td>{{ $pro->total_sales }}</td>
                                    <td>{{ $pro->jumlah_produk }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="card">
            <div class="card-body">
                <canvas id="highestSellingProductsChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Low Quantity Products</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
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
                    <h3>Latest Sales</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Date</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestSale as $sell)
                                <tr>
                                    <td>{{ $sell->product_name }}</td>
                                    <td>{{ $sell->date }}</td>
                                    <td>{{ $sell->quantity }}</td>
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
                    <h3>Recently Added Products</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentlyAddedProducts as $product)
                                <tr>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>{{ $product->harga_produk }}</td>
                                    <td>{{ $product->jumlah_produk }}</td>
                                    <td>{{ $product->kategori_produk }}</td>
                                    <td>{{ $product->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    const canvas = document.getElementById('highestSellingProductsChart');
    canvas.width = 400;
    canvas.height = 400; 

    const ctx = document.getElementById('highestSellingProductsChart').getContext('2d');
    const highestSellingProductsChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($productNames) !!},
            datasets: [{
                data: {!! json_encode($productSales) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Highest Selling Products'
                }
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Check if there are any low quantity products and show the toast if so
        @if ($lowQuantityExists)
            const toast = new bootstrap.Toast(document.querySelector('.low-quantity-toast'));
            toast.show();
        @endif
    });
</script>


@endsection