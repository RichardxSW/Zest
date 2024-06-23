<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>

@foreach ($product as $pro)
<div class="modal fade" id="editProductModal{{ $pro->id }}" tabindex="-1"  aria-labelledby="editProductModalLabel{{ $pro->id }}" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel{{ $pro->id }}">Edit Product {{ $pro->nama_produk }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.update', $pro->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <input type="text" class="form-control" name="nama_produk" value="{{ $pro->nama_produk }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" name="harga_produk" value="{{ $pro->harga_produk }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="jumlah_produk" value="{{ $pro->jumlah_produk }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="kategori_produk" value="{{ $pro->kategori_produk }}">
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div> -->

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach