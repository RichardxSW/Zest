@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>
@endpush

<!-- Add Purchase Modal -->
<div class="modal fade" id="addPurchaseModal" tabindex="-1" role="dialog" aria-labelledby="addPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPurchaseModalLabel">Add New Purchase</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('totalpurchase.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <select class="form-control" name="product_name" required>
                            <option value="" disabled selected>Select a product name</option>
                            @foreach($product as $pro)
                                <option value="{{ $pro->nama_produk }}">{{ $pro->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier Name</label>
                        <select class="form-control" name="supplier_name" required>
                            <option value="" disabled selected>Select a supplier name</option>
                            @foreach($supplier as $sup)
                                <option value="{{ $sup->name }}">{{ $sup->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="quantity">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">In Date</label>
                        <input type="date" class="form-control" name="in_date">
                    </div>

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>