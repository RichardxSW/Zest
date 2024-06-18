@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addSupplierModal"><i class="fas fa-plus"></i> Add New Supplier</button>
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

@endsection