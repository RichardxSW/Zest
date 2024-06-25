@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPurchaseForm" action="{{ route('totalpurchase.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" name="category" id="category" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->kategori }}">{{ $category->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <select class="form-control" name="product_name" id="product_name" required disabled>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->nama_produk }}" data-category="{{ $product->kategori_produk }}">{{ $product->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" name="supplier_name">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const productSelect = document.getElementById('product_name');
        const allOptions = Array.from(productSelect.querySelectorAll('option'));
        const form = document.getElementById('addPurchaseForm');

        // Disable product dropdown initially
        productSelect.disabled = true;

        categorySelect.addEventListener('change', function() {
            const selectedCategory = this.value;

            // Clear the current product options
            productSelect.innerHTML = '<option value="">Select Product</option>';

            // Filter and add options that match the selected category
            allOptions.forEach(option => {
                if (option.getAttribute('data-category') === selectedCategory) {
                    productSelect.appendChild(option);
                }
            });

            // Reset the product select to show the first option and enable it
            productSelect.selectedIndex = 0;
            productSelect.disabled = selectedCategory === '' ? true : false;
        });

        // Clear form on modal close
        $('#addPurchaseModal').on('hidden.bs.modal', function () {
            form.reset();
            productSelect.disabled = true;
            productSelect.innerHTML = '<option value="">Select Product</option>';
        });
    });
</script>