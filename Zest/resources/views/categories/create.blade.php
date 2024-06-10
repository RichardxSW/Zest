@extends('layouts.template')

@section('content')
<section class="page-section bg-light" id="portfolio">
            <div class="container">
            <h1 class="mt-5">Tambah Kategori</h1>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" name="kategori">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="text" class="form-control" name="jumlah">
                </div>
               <!--  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <input type="text" class="form-control" name="jurusan">
                </div> -->

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('categories.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </section>
@endsection
