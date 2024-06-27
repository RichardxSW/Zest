@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('/css/category.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col">
            <h3>Category List</h3>
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

    <div class="row mb-1">
        <div class="col-auto">
            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="fas fa-plus"></i> Add New Category
            </button>
        </div>
    </div>

    <div class="box-body">
        <table id="categoryTable" class="table table-bordered table-striped">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Category</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Products</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($category as $cat)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $cat->kategori }}</td>
            <td>{{ $cat->jumlah }} </td>
            <td>{{ $cat->total_products }}</td>
            <td>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $cat->id }}">
                    <i class="fas fa-pencil-alt"></i> Edit
                </button>
                <form action="{{ route('categories.delete', $cat->id) }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>Delete
                    </button>
                </form>
            </td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
</div>

@include('categories.create')
@include('categories.edit')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categoryTable').DataTable({
            "columnDefs": [
                { 
                    "searchable": false,
                    "targets": [0,4]
                }, 
            ]
        });
    });

    setTimeout(function(){
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endsection