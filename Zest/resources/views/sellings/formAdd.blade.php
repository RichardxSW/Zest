<!-- Add Selling Modal -->
<div class="modal fade" id="addSellingModal" tabindex="-1" aria-labelledby="addSellingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSellingModalLabel">Add New Selling Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSellingForm" action="{{ route('sellings.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <select class="form-control" name="category_name" id="category_name" required>
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
                        <label class="form-label">Customer Name</label>
                        <select class="form-control" id="customer_name_select" name="customer_name_select">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->nama_customer }}">{{ $customer->nama_customer }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control mt-2" id="customer_name_input" name="customer_name_input" placeholder="Or add new customer">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" required min="0" oninput="this.value = Math.abs(this.value)">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                    <button type="button" class="btn btn-danger mt-3" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_name');
        const productSelect = document.getElementById('product_name');
        const allOptions = Array.from(productSelect.querySelectorAll('option'));
        const form = document.getElementById('addSellingForm');

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
        $('#addSellingModal').on('hidden.bs.modal', function () {
            form.reset();
            productSelect.disabled = true;
            productSelect.innerHTML = '<option value="">Select Product</option>';
        });
    });
</script>