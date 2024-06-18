@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row mb-3 justify-content-between"> <!-- Menggunakan kelas justify-content-between di sini -->
        <div class="col-auto">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSupplierModal"><i class="fas fa-plus"></i> Add New Supplier</button>
        </div>
        <div class="col-auto ml-auto"> <!-- Menambahkan kelas ml-auto pada div ini -->
            <form action="{{ route('supplier.search') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" name="query" placeholder="Search Supplier">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
              <th width="5%" scope="col">ID</th>
              <th width="18%" scope="col">Name</th>
              <th width="18%" scope="col">Address</th>
              <th width="18%" scope="col">Email</th>
              <th width="18%" scope="col">Contact</th>
              <th width="26%" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($supplier as $sup)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sup->name }}</td>
                <td>{{ $sup->address }}</td>
                <td>{{ $sup->email }}</td>
                <td>{{ $sup->contact }}</td>
                <td>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editSupplierModal{{ $sup->id }}"><i class="fas fa-pencil-alt"></i> Edit</button>
                  <form action="{{ route('supplier.delete', $sup->id) }}" method="POST" class="d-inline">
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

@include('supplier.create')
@include('supplier.edit')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('.table tbody tr');

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
    });
</script>

@endsection