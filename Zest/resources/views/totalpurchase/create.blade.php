<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>

<!-- Add Purchase Modal -->
<div class="modal fade" id="addPurchaseModal" tabindex="-1" role="dialog" aria-labelledby="addPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPurchaseModalLabel">Add New Purchase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>