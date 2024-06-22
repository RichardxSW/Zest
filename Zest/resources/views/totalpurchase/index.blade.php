@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row mb-3 justify-content-between">
        <div class="col-auto">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPurchaseModal"><i class="fas fa-plus"></i> Add New Purchase</button>
        </div>
        <div class="col-auto ml-auto">
            <form action="{{ route('totalpurchase.search') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" name="query" placeholder="Search Purchase">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%" scope="col">#</th>
                <th width="18%" scope="col">
                    Product Name 
                    <button id="sortName" class="btn btn-link p-0">
                        <i class="fas fa-sort sort-icon"></i>
                    </button>
                </th>
                <th width="18%" scope="col">
                    Supplier Name 
                    <button id="sortName" class="btn btn-link p-0">
                        <i class="fas fa-sort sort-icon"></i>
                    </button>
                </th>
                <th width="18%" scope="col">Quantity</th>
                <th width="18%" scope="col">In date</th>
                <th width="26%" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($purchase as $pur)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pur->product_name }}</td>
                <td>{{ $pur->supplier_name }}</td>
                <td>{{ $pur->quantity }}</td>
                <td>{{ $pur->in_date }}</td>
                <td>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editPurchaseModal{{ $pur->id }}"><i class="fas fa-pencil-alt"></i> Edit</button>
                  <form action="{{ route('totalpurchase.delete', $pur->id) }}" method="POST" class="d-inline">
                      @method('delete')
                      @csrf
                      <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                  </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@include('totalpurchase.create')
@include('totalpurchase.edit')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('.table tbody tr');
        const sortButton = document.getElementById('sortName');
        let sortOrder = 'asc';

        searchInput.addEventListener('input', function () {
            const searchText = searchInput.value.toLowerCase();
            tableRows.forEach(row => {
                const nameCell = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const addressCell = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const emailCell = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                const contactCell = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                if (
                    nameCell.includes(searchText) ||
                    addressCell.includes(searchText) ||
                    emailCell.includes(searchText) ||
                    contactCell.includes(searchText)
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        sortButton.addEventListener('click', function () {
            const rowsArray = Array.from(tableRows);
            rowsArray.sort((a, b) => {
                const nameA = a.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const nameB = b.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (nameA < nameB) {
                    return sortOrder === 'asc' ? -1 : 1;
                }
                if (nameA > nameB) {
                    return sortOrder === 'asc' ? 1 : -1;
                }
                return 0;
            });
            sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            rowsArray.forEach(row => document.querySelector('.table tbody').appendChild(row));
        });
    });
</script>

@endsection
