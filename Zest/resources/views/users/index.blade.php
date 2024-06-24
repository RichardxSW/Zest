@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <!-- <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add Product</a> -->

    <div class="row mb-3 justify-content-between">
    <!-- <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Product</a> -->
    <div class="col-auto">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-plus"></i> Add New User</button>
        </div>
        <div class="col-auto ml-auto">
            <form action="{{ route('users.search') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" name="query" placeholder="Search User">
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
      <th scope="col">#</th>
      <th scope="col">User name 
      <button id="sortName" class="btn btn-link p-0">
          <i class="fas fa-sort sort-icon"></i>
        </button>
      </th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($users as $user)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user-> name }}</td>
                <td>{{ $user-> email }} </td>
                <td>{{ $user-> role }} </td>
                <td>
                    <!-- <a href="#" class="btn btn-warning">Edit</a> -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal{{ $user->id }}"><i class="fas fa-pencil-alt"></i> Edit</button>

                    <!-- <a href="#" class="btn btn-danger">Delete</a> -->
                    <form action="{{ route('users.delete', $user->id) }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
                    </form>
                </td>
                </tr>
                @endforeach
  </tbody>
</table>
</div>

@include('users.create')
@include('users.edit')

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
                const emailCell = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const roleCell = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                // const categoryCell = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                if (
                    nameCell.includes(searchText) ||
                    emailCell.includes(searchText) ||
                    roleCell.includes(searchText)
                    // categoryCell.includes(searchText)
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