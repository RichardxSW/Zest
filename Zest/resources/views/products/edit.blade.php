<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>

@foreach ($product as $pro)
<div class="modal fade" id="editProductModal{{ $pro->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $pro->id }}" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel{{ $pro->id }}">Edit Product {{ $pro->nama_produk }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm{{ $pro->id }}" action="{{ route('products.update', $pro->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" name="kategori_produk" id="edit_kategori_produk{{ $pro->id }}" required>
                            <option value="" disabled>Select a category</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->kategori }}" {{ $pro->kategori_produk == $cat->kategori ? 'selected' : '' }}>{{ $cat->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="nama_produk" id="edit_nama_produk{{ $pro->id }}" value="{{ $pro->nama_produk }}" required>
                        <div id="edit-product-error{{ $pro->id }}" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" name="harga_produk" id="edit_harga_produk{{ $pro->id }}" value="{{ number_format($pro->harga_produk, 0, ',', '.') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="jumlah_produk" id="edit_jumlah_produk{{ $pro->id }}" value="{{ $pro->jumlah_produk }}">
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="editSubmitProductBtn{{ $pro->id }}" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const existingProducts = @json($product->pluck('nama_produk'));

        @foreach ($product as $pro)
        (function() {
            const productInput = document.getElementById('edit_nama_produk{{ $pro->id }}');
            const productError = document.getElementById('edit-product-error{{ $pro->id }}');
            const submitProductBtn = document.getElementById('editSubmitProductBtn{{ $pro->id }}');
            const categorySelect = document.getElementById('edit_kategori_produk{{ $pro->id }}');
            const priceInput = document.getElementById('edit_harga_produk{{ $pro->id }}');
            const quantityInput = document.getElementById('edit_jumlah_produk{{ $pro->id }}');

            const originalData = {
                productName: productInput.value,
                category: categorySelect.value,
                price: priceInput.value,
                quantity: quantityInput.value
            };

            productInput.addEventListener('input', function() {
                validateProductName();
            });

            function validateProductName() {
                const productName = productInput.value.trim().toLowerCase();
                const productExists = existingProducts.some(product => product.toLowerCase() === productName && productName !== originalData.productName.toLowerCase());

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

            $('#editProductModal{{ $pro->id }}').on('hidden.bs.modal', function() {
                productInput.value = originalData.productName;
                productError.textContent = '';
                productInput.classList.remove('is-invalid');
                submitProductBtn.disabled = false;
                priceInput.value = originalData.price;
                quantityInput.value = originalData.quantity;
                categorySelect.value = originalData.category;
            });

            document.getElementById('editProductForm{{ $pro->id }}').addEventListener('submit', function(event) {
                validateProductName();
                if (submitProductBtn.disabled) {
                    event.preventDefault();
                }
            });
        })();
        @endforeach
    });
</script>