@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('/css/purchase.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid mb-5">
    <div class="row mb-2">
        <div class="col">
            <h3>Purchase Product List</h3>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row mb-1 justify-content-between">
        <div class="col-auto">
            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addPurchaseModal"><i class="fas fa-plus"></i> Add New Purchase</button>
            <button type="button" class="btn btn-danger mb-2" onclick="window.location.href='{{ route('totalpurchase.exportPdf') }}'">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
            <button type="button" class="btn btn-primary mb-2" onclick="window.location.href='{{ route('totalpurchase.exportXls') }}'">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
        </div>
        <div class="col-auto">
            <a href="{{ route('totalpurchase.dailyPurchases') }}" class="btn btn-info mb-2 position-relative">
                Daily Purchases
            </a>

            <a href="{{ route('totalpurchase.monthlyPurchases') }}" class="btn btn-warning mb-2 position-relative">
                Monthly Sales
            </a>
        </div>
    </div>
    <div class="box-body">
    <table id="purTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Category</th>
                <th scope="col">Product Name</th>
                <th scope="col">Supplier Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($purchase as $pur)
            <tr>
                <td>{{ $pur->id }}</td>
                <td>{{ $pur->category }}</td>
                <td>{{ $pur->product_name }}</td>
                <td>{{ $pur->supplier_name }}</td>
                <td>{{ $pur->quantity }}</td>
                <td>{{ $pur->in_date }}</td>
                <td>
                    @if($pur->status === 'approved')
                        <span class="badge rounded-pill bg-success" style="width: 80px";>Approved</span>
                    @elseif ($pur->status === 'pending')
                        <span class="badge rounded-pill bg-warning" style="width: 80px"; >Pending</span>
                    @else 
                        <span class="badge rounded-pill bg-danger" style="width: 80px";>Declined</span>
                    @endif  
                </td>
                <td>
                @if ($pur->status == 'approved' || $pur->status === 'declined')
                    No Action
                @else
                    <div class="d-flex justify-content-between align-items-center"></div>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPurchaseModal{{ $pur->id }}">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </button>
                        <form action="{{ route('totalpurchase.delete', $pur->id) }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col">
            <h3>Export Receipt</h3>
        </div>
    </div>
    <div class="box-body">
        <table id="invTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($purchase as $pur)
                @if ($pur->status === 'approved')
                <tr>
                    <td>{{ $pur->id }}</td>
                    <td>{{ $pur->category }}</td>
                    <td>{{ $pur->product_name }}</td>
                    <td>{{ $pur->supplier_name }}</td>
                    <td>{{ $pur->quantity }}</td>
                    <td>{{ $pur->in_date }}</td>
                    <td>
                        <span class="badge rounded-pill bg-success" style="width: 80px";>Approved</span>
                    </td>
                    <td>
                        <a href="{{ route('totalpurchase.exportReceipt', $pur->id) }}" class="btn btn-success"><i class="fas fa-file-pdf"></i> Export Receipt</a>
                    </td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Purchase Modal -->
@include('totalpurchase.create')
<!-- Edit Purchase Modal -->
@include('totalpurchase.edit')


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#purTable').DataTable({
            "columnDefs": [
                { 
                    "searchable": false,
                    "targets": [0,7]
                }, 
            ]
        });
        $('#invTable').DataTable({
            "columnDefs": [
                { 
                    "searchable": false,
                    "targets": [0,7]
                }, 
            ]
        });
    });
</script>
<script>
    setTimeout(function(){
        $('.alert').fadeOut('slow');
    }, 5000);
</script>

@endsection