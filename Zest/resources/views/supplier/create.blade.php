@extends('layouts.template')

@section('content')
<section class="page-section bg-light" id="portfolio">
            <div class="container">
            <h1 class="mt-5">Add Suppliers</h1>
                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div> 
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone">
                </div>

                <a href="{{ route('supplier.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
@endsection
