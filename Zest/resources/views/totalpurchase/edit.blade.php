@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>
@endpush

<!-- Edit Purchase Modals -->
@foreach ($purchase as $pur)
<div class="modal fade" id="editPurchaseModal{{ $pur->id }}" tabindex="-1" role="dialog" aria-labelledby="editPurchaseModalLabel{{ $pur->id }}" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPurchaseModalLabel{{ $pur->id }}">Edit Purchase Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm{{ $pur->id }}" action="{{ route('totalpurchase.update', $pur->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" name="category" id="category_name_edit_{{ $pur->id }}" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->kategori }}" {{ $pur->category_name == $category->kategori ? 'selected' : '' }}>{{ $category->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <select class="form-control" name="product_name" id="product_name_edit_{{ $pur->id }}" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->nama_produk }}" data-category="{{ $product->kategori_produk }}" {{ $pur->product_name == $product->nama_produk ? 'selected' : '' }}>{{ $product->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier Name</label>
                        <select class="form-control" name="supplier_name" id="supplier_name_edit_{{ $pur->id }}" required>
                            <option value="">Select Supplier</option>
                            @foreach($supplier as $sup)
                                <option value="{{ $sup->name }}" {{ $pur->supplier_name == $sup->name ? 'selected' : '' }}>{{ $sup->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="quantity" value="{{ $pur->quantity }}" required min="1" oninput="handleQuantityInput(this)">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">In Date</label>
                        <input type="date" class="form-control" name="in_date" value="{{ $pur->in_date }}" required readonly>
                    </div>

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($purchase as $pur)
        (function() {
            const categorySelectEdit = document.getElementById('category_name_edit_{{ $pur->id }}');
            const productSelectEdit = document.getElementById('product_name_edit_{{ $pur->id }}');
            const allOptionsEdit = Array.from(document.querySelectorAll('#product_name_edit_{{ $pur->id }} option'));
            const originalData = {
                category: categorySelectEdit.value,
                product: productSelectEdit.value,
                supplierName: document.querySelector('#supplier_name_edit_{{ $pur->id }}').value,
                quantity: document.querySelector('#editForm{{ $pur->id }} input[name="quantity"]').value,
                date: document.querySelector('#editForm{{ $pur->id }} input[name="in_date"]').value
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
                if (productSelectEdit.querySelector(`option[value="{{ $pur->product_name }}"]`)) {
                    productSelectEdit.value = "{{ $pur->product_name }}";
                }
            }

            populateEditProductOptions();

            categorySelectEdit.addEventListener('change', function() {
                productSelectEdit.selectedIndex = 0;
                populateEditProductOptions();
            });

            // Reset form data when modal is closed
            const modalElement = document.getElementById('editPurchaseModal{{ $pur->id }}');
            modalElement.addEventListener('hidden.bs.modal', function() {
                categorySelectEdit.value = originalData.category;
                document.querySelector('#supplier_name_edit_{{ $pur->id }}').value = originalData.supplierName;
                document.querySelector('#editForm{{ $pur->id }} input[name="quantity"]').value = originalData.quantity;
                document.querySelector('#editForm{{ $pur->id }} input[name="in_date"]').value = originalData.date;
                populateEditProductOptions();
                productSelectEdit.value = originalData.product;
            });
        })();
        @endforeach
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