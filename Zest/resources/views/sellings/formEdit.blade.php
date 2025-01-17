@foreach ($sellings as $sell)
<div class="modal fade" id="editSellingModal{{ $sell->id }}" tabindex="-1" aria-labelledby="editSellingModalLabel{{ $sell->id }}" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSellingModalLabel{{ $sell->id }}">Edit Selling Product Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm{{ $sell->id }}" action="{{ route('sellings.update', $sell->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <select class="form-control" name="category_name" id="category_name_edit_{{ $sell->id }}" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->kategori }}" {{ $sell->category_name == $category->kategori ? 'selected' : '' }}>{{ $category->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <select class="form-control" name="product_name" id="product_name_edit_{{ $sell->id }}" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->nama_produk }}" data-category="{{ $product->kategori_produk }}" data-stock="{{ $product->jumlah_produk }}" {{ $sell->product_name == $product->nama_produk ? 'selected' : '' }}>{{ $product->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <select class="form-control" name="customer_name" id="customer_name_edit_{{ $sell->id }}" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->nama_customer }}" {{ $sell->customer_name == $customer->nama_customer ? 'selected' : '' }}>{{ $customer->nama_customer }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity_edit_{{ $sell->id }}" min="1" oninput="validateEditQuantity({{ $sell->id }})" value="{{ $sell->quantity }}">
                        <div id="quantity-error-edit-{{ $sell->id }}" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" value="{{ $sell->date }}" readonly>
                    </div>
                    <button type="submit" id="submitBtnEdit{{ $sell->id }}" class="btn btn-success mt-3">Submit</button>
                    <button type="button" class="btn btn-danger mt-3" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($sellings as $sell)
        (function() {
            const categorySelectEdit = document.getElementById('category_name_edit_{{ $sell->id }}');
            const productSelectEdit = document.getElementById('product_name_edit_{{ $sell->id }}');
            const quantityInputEdit = document.getElementById('quantity_edit_{{ $sell->id }}');
            const quantityErrorEdit = document.getElementById('quantity-error-edit-{{ $sell->id }}');
            const submitBtnEdit = document.getElementById('submitBtnEdit{{ $sell->id }}');
            const allOptionsEdit = Array.from(document.querySelectorAll('#product_name_edit_{{ $sell->id }} option'));
            const originalData = {
                category: categorySelectEdit.value,
                product: productSelectEdit.value,
                customerName: document.querySelector('#customer_name_edit_{{ $sell->id }}').value,
                quantity: quantityInputEdit.value,
                date: document.querySelector('#editForm{{ $sell->id }} input[name="date"]').value
            };

            function populateEditProductOptions() {
                const selectedCategoryEdit = categorySelectEdit.value;
                productSelectEdit.innerHTML = '<option value="">Select Product</option>';

                allOptionsEdit.forEach(option => {
                    if (option.getAttribute('data-category') === selectedCategoryEdit) {
                        productSelectEdit.appendChild(option.cloneNode(true));
                    }
                });

                productSelectEdit.disabled = selectedCategoryEdit === '' ? true : false;

                // Retain the previously selected product
                if (productSelectEdit.querySelector(`option[value="{{ $sell->product_name }}"]`)) {
                    productSelectEdit.value = "{{ $sell->product_name }}";
                }
            }

            function validateEditQuantity(sellId) {
                const selectedProduct = productSelectEdit.options[productSelectEdit.selectedIndex];
                const maxQuantity = parseInt(selectedProduct.getAttribute('data-stock'));
                const enteredQuantity = parseInt(quantityInputEdit.value);

                if (enteredQuantity > maxQuantity) {
                    quantityErrorEdit.textContent = 'Quantity exceeds available stock.';
                    quantityInputEdit.classList.add('is-invalid');
                    submitBtnEdit.disabled = true;
                } else {
                    quantityErrorEdit.textContent = '';
                    quantityInputEdit.classList.remove('is-invalid');
                    submitBtnEdit.disabled = false;
                }
            }

            populateEditProductOptions();

            categorySelectEdit.addEventListener('change', function() {
                productSelectEdit.selectedIndex = 0;
                populateEditProductOptions();
            });

            productSelectEdit.addEventListener('change', function() {
                validateEditQuantity({{ $sell->id }});
            });
            quantityInputEdit.addEventListener('input', function() {
                validateEditQuantity({{ $sell->id }});
            });

            // Reset form data when modal is closed
            const modalElement = document.getElementById('editSellingModal{{ $sell->id }}');
            modalElement.addEventListener('hidden.bs.modal', function() {
                categorySelectEdit.value = originalData.category;
                document.querySelector('#customer_name_edit_{{ $sell->id }}').value = originalData.customerName;
                quantityInputEdit.value = originalData.quantity;
                document.querySelector('#editForm{{ $sell->id }} input[name="date"]').value = originalData.date;
                populateEditProductOptions();
                productSelectEdit.value = originalData.product;
                quantityErrorEdit.textContent = '';
                quantityInputEdit.classList.remove('is-invalid');
                submitBtnEdit.disabled = false;
            });
        })();
        @endforeach
    });
</script>