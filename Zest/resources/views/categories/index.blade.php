@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category</th>
      <th scope="col">Quantity</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($category as $cat)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cat-> kategori }}</td>
                <td>{{ $cat-> jumlah }} </td>
                <td>
                    <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-warning">Edit</a>
                    <!-- <a href="#" class="btn btn-danger">Delete</a> -->
                    <form action="{{ route('categories.delete', $cat->id) }}" method="POST" class="d-inline">
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
