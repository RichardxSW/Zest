@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Produk</th>
      <th scope="col">Harga Produk</th>
      <th scope="col">Jumlah Produk</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($product as $pro)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pro-> nama_produk }}</td>
                <td>{{ $pro-> harga_produk }} </td>
                <td>{{ $pro-> jumlah_produk }} </td>
                <td>{{ $pro-> kategori_produk }} </td>
                <td>
                    <a href="#" class="btn btn-warning">Edit</a>
                    <!-- <a href="#" class="btn btn-danger">Delete</a> -->
                    <form action="{{ route('products.delete', $pro->id) }}" method="POST" class="d-inline">
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