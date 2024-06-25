<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>

<!-- Add Selling Modal -->
<div class="modal fade" id="addSellingModal" tabindex="-1" aria-labelledby="addSellingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSellingModalLabel">Add New Selling Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sellings.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <select class="form-control" name="product_name" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->nama_produk }}">{{ $product->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <select class="form-control" name="category_name" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->kategori }}">{{ $category->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" class="form-control" name="customer_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" required min="0" oninput="this.value = Math.abs(this.value)">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>