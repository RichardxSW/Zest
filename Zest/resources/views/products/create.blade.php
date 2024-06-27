<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>

<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" name="kategori_produk" id="kategori_produk" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->kategori }}">{{ $cat->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="nama_produk" id="nama_produk" required>
                        <div id="product-error" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" name="harga_produk" id="harga_produk">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="jumlah_produk" id="jumlah_produk">
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="submitProductBtn" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productInput = document.getElementById('nama_produk');
        const productError = document.getElementById('product-error');
        const submitProductBtn = document.getElementById('submitProductBtn');
        const priceInput = document.getElementById('harga_produk');
        const quantityInput = document.getElementById('jumlah_produk');
        const categorySelect = document.getElementById('kategori_produk');
        const existingProducts = @json($product->pluck('nama_produk'));

        productInput.addEventListener('input', validateProductName);

        function validateProductName() {
            const productName = productInput.value.trim().toLowerCase();
            const productExists = existingProducts.some(product => product.toLowerCase() === productName);

            if (productExists) {
                productError.textContent = 'Product name already exists.';
                productInput.classList.add('is-invalid');
                submitProductBtn.disabled = true;
            } else {
                productError.textContent = '';
                productInput.classList.remove('is-invalid');
                submitProductBtn.disabled = false;
            }
        }
       
        quantityInput.addEventListener('input', function() {
            let value = Math.abs(parseInt(quantityInput.value));
            quantityInput.value = value || '';
        });

        // Clear form on modal close
        $('#addProductModal').on('hidden.bs.modal', function () {
            productInput.value = '';
            productError.textContent = '';
            productInput.classList.remove('is-invalid');
            submitProductBtn.disabled = false;
            priceInput.value = '';
            quantityInput.value = '';
            categorySelect.selectedIndex = 0; // Reset category select to default
        });

        // Trigger validation on form submit
        document.getElementById('addProductForm').addEventListener('submit', function(event) {
            validateProductName();
            if (submitProductBtn.disabled) {
                event.preventDefault();
            }
        });
    });
</script>