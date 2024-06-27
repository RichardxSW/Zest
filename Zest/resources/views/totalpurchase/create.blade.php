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
                        <div class="input-group">
                            <select class="form-control" id="supplier_name_select" name="supplier_name_select">
                                <option value="">Select Supplier</option>
                                @foreach($supplier as $sup)
                                    <option value="{{ $sup->name }}">{{ $sup->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control d-none" id="supplier_name_input" name="supplier_name_input" placeholder="Enter new supplier name">
                            <button type="button" id="toggleSupplierInput" class="btn btn-secondary ms-2 small-button">New Supplier</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="quantity" id="quantity" required min="1" oninput="handleQuantityInput(this)">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">In Date</label>
                        <input type="date" class="form-control" name="in_date" value="{{ date('Y-m-d') }}" required readonly>
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
        const toggleSupplierButton = document.getElementById('toggleSupplierInput');
        const supplierSelect = document.getElementById('supplier_name_select');
        const supplierInput = document.getElementById('supplier_name_input');

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

        toggleSupplierButton.addEventListener('click', function() {
            const isSelectVisible = !supplierSelect.classList.contains('d-none');
            supplierSelect.classList.toggle('d-none', isSelectVisible);
            supplierInput.classList.toggle('d-none', !isSelectVisible);
            toggleSupplierButton.textContent = isSelectVisible ? 'Cancel' : 'New Supplier';
            toggleSupplierButton.classList.toggle('btn-danger', isSelectVisible);
            toggleSupplierButton.classList.toggle('btn-secondary', !isSelectVisible);
        });

        // Clear form on modal close
        $('#addPurchaseModal').on('hidden.bs.modal', function () {
            form.reset();
            productSelect.disabled = true;
            productSelect.innerHTML = '<option value="">Select Product</option>';
        });
    });

    function handleQuantityInput(input) {
        if (input.value === '0') {
            input.value = '1';
        } else if (input.value === '') {
            input.value = '';
        } else if (input.value < 1) {
            input.value = '1';
        }
    }
</script>