@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
<div class="container">
    <h1 class="mb-4">Daily Purchases Report</h1>

    <form action="{{ route('totalpurchase.dailyPurchases') }}" method="GET">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date', \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date', \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </div>
        </div>
    </form>

    @if (request()->has('start_date') && request()->has('end_date'))
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Total Purchases Per Product</h3>
                </div>
                <div class="card-body">
                    <table id="totalPurchasesPerProductTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Total Purchased</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalDailyPurchases as $product => $total)
                                <tr>
                                    <td>{{ $product }}</td>
                                    <td>{{ $total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Total Purchases Per Category</h3>
                </div>
                <div class="card-body">
                    <table id="totalPurchasesPerCategoryTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Total Purchased</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalDailyPurchasesPerCategory as $category => $total)
                                <tr>
                                    <td>{{ $category }}</td>
                                    <td>{{ $total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Detailed Purchases</h3>
        </div>
        <div class="card-body">
            <table id="detailedPurchasesTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Purchase Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dailyPurchases as $purchase)
                        <tr>
                            <td>{{ $purchase->id }}</td>
                            <td>{{ $purchase->product_name }}</td>
                            <td>{{ $purchase->supplier_name }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>{{ $purchase->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#totalPurchasesPerProductTable').DataTable();
        $('#totalPurchasesPerCategoryTable').DataTable();
        $('#detailedPurchasesTable').DataTable();
    });
</script>

@endsection
