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
                        <div class="input-group">
                            <select class="form-control" id="customer_name_select" name="customer_name_select">
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->nama_customer }}">{{ $customer->nama_customer }}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control d-none" id="customer_name_input" name="customer_name_input" placeholder="Enter new customer name">
                            <button type="button" id="toggleCustomerInput" class="btn btn-secondary ms-2 small-button">New Customer</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" required min="1" oninput="this.value = Math.max(1, this.value)" value="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="date" required readonly>
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
        const toggleCustomerButton = document.getElementById('toggleCustomerInput');
        const customerSelect = document.getElementById('customer_name_select');
        const customerInput = document.getElementById('customer_name_input');
        const dateInput = document.getElementById('date');

        // Set date input to today's date
        const today = new Date().toISOString().split('T')[0];
        dateInput.value = today;

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

        // Toggle between select and input for customer name
        toggleCustomerButton.addEventListener('click', function() {
            const isSelectVisible = !customerSelect.classList.contains('d-none');
            customerSelect.classList.toggle('d-none', isSelectVisible);
            customerInput.classList.toggle('d-none', !isSelectVisible);
            toggleCustomerButton.textContent = isSelectVisible ? 'Cancel' : 'New Customer';
            toggleCustomerButton.classList.toggle('btn-danger', isSelectVisible);
            toggleCustomerButton.classList.toggle('btn-secondary', !isSelectVisible);
        });

        // Clear form on modal close
        $('#addSellingModal').on('hidden.bs.modal', function () {
            form.reset();
            productSelect.disabled = true;
            productSelect.innerHTML = '<option value="">Select Product</option>';
            customerSelect.classList.remove('d-none');
            customerInput.classList.add('d-none');
            toggleCustomerButton.textContent = 'New Customer';
            toggleCustomerButton.classList.remove('btn-danger');
            toggleCustomerButton.classList.add('btn-secondary');
            
            // Reset date input to today's date
            dateInput.value = today;
        });
    });
</script>

<style>
    .input-group .btn {
        white-space: nowrap;
    }

    .input-group .small-button {
        width: 120px;
    }
</style>