@extends('layouts.template')

@section('content')
<div class="container-fluid">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kategori</th>
      <th scope="col">Jumlah</th>
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
                    <a href="#" class="btn btn-warning">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                </td>
                </tr>
                @endforeach
  </tbody>
</table>
</div>
@endsection
