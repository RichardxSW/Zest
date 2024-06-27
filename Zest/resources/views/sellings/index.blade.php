@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('/css/selling.css') }}" rel="stylesheet">
<style>
   .paginate_button.active > .page-link {
        background-color: red !important;
        border-color: red;
        color: white;
    }

</style>
@endpush

@section('content')
<div class="container-fluid mb-5">
    <div class="row mb-2">
        <div class="col">
            <h3>Selling Product List</h3>
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
            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addSellingModal"><i class="fas fa-plus"></i> Add New Selling Product</button>
            <button type="button" class="btn btn-danger mb-2" onclick="window.location.href='{{ route('sellings.exportPdf') }}'">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
            <button type="button" class="btn btn-primary mb-2" onclick="window.location.href='{{ route('sellings.exportXls') }}'">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
        </div>
        <div class="col-auto">
            <a href="{{ route('sellings.dailySales') }}" class="btn btn-info mb-2 position-relative">
                Daily Sales
            </a>

            <a href="{{ route('sellings.monthlySales') }}" class="btn btn-warning mb-2 position-relative">
                Monthly Sales
            </a>
        </div>
    </div>
    <div class="box-body">
        <table id="sellTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($sellings as $selling)
                <tr>
                    <td>{{ $selling->id }}</td>
                    <td>{{ $selling->product_name }}</td>
                    <td>{{ $selling->category_name }}</td>
                    <td>{{ $selling->customer_name }}</td>
                    <td>{{ $selling->quantity }}</td>
                    <td>{{ $selling->date }}</td>
                    <td>
                        @if($selling->status === 'approved')
                            <span class="badge rounded-pill bg-success" style="width: 80px";>Approved</span>
                        @elseif ($selling->status === 'pending')
                            <span class="badge rounded-pill bg-warning" style="width: 80px"; >Pending</span>
                        @else
                            <span class="badge rounded-pill bg-danger" style="width: 80px";>Declined</span>
                        @endif
                    </td>
                    <td>
                        @if($selling->status === 'approved' || $selling->status === 'declined')
                            No Action
                        @else
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-warning btn-sm equal-width-btn me-2" data-bs-toggle="modal" data-bs-target="#editSellingModal{{ $selling->id }}">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </button>
                                <form action="{{ route('sellings.delete', $selling->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm equal-width-btn">
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
            <h3>Export invoice</h3>
        </div>
    </div>
    <div class="box-body">
        <table id="invTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sellings as $selling)
                    @if($selling->status === 'approved')
                        <tr>
                            <td>{{ $selling->id }}</td>
                            <td>{{ $selling->product_name }}</td>
                            <td>{{ $selling->category_name }}</td>
                            <td>{{ $selling->customer_name }}</td>
                            <td>{{ $selling->quantity }}</td>
                            <td>{{ $selling->date }}</td>
                            <td>
                                <span class="badge rounded-pill bg-success" style="width: 80px";>Approved</span>
                            </td>    
                            <td>
                                <a href="{{ route('sellings.exportInv', $selling->id) }}" class="btn btn-success"><i class="fas fa-file-pdf"></i> Export Invoice</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>            
        </table>
    </div>
</div>

<!-- Add Selling Modal -->
@include('sellings.formAdd')
<!-- Edit Selling Modal -->
@include('sellings.formEdit')


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#sellTable').DataTable({
            "columnDefs": [
                { 
                    "searchable": false,
                    "targets": [0,5,6,7]
                }, 
            ]
        });

        $('#invTable').DataTable({
            "columnDefs": [
                { 
                    "searchable": false,
                    "targets": [0,5,6,7]
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