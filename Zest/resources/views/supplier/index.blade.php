@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <a href="{{ route('supplier.create') }}" class="btn btn-primary mb-3">Add Suppliers</a>

    @if(session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">Email</th>
      <th scope="col">Contact</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($supplier as $sup)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sup-> name }}</td>
                <td>{{ $sup-> address }} </td>
                <td>{{ $sup-> email }} </td>
                <td>{{ $sup-> contact }} </td>
                <td>
                    <a href="#" class="btn btn-warning">Edit</a>
                    <!-- <a href="#" class="btn btn-danger">Delete</a> -->
                    <form action="{{ route('products.delete', $sup->id) }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                </tr>
                @endforeach
  </tbody>
</table>
</div>
@endsection