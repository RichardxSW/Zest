@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
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
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('totalpurchase.update', $pur->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <select class="form-control" name="product_name" required>
                            <option value="" disabled selected>Select a product name</option>
                            @foreach($product as $pro)
                                <option value="{{ $pro->nama_produk }}" {{ $pur->product_name == $pro->nama_produk ? 'selected' : '' }}>
                                    {{ $pro->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplier Name</label>
                        <select class="form-control" name="supplier_name" required>
                            <option value="" disabled selected>Select a supplier name</option>
                            @foreach($supplier as $sup)
                                <option value="{{ $sup->name }}" {{ $pur->supplier_name == $sup->name ? 'selected' : '' }}>
                                    {{ $sup->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="quantity" value="{{ $pur->quantity }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">In Date</label>
                        <input type="date" class="form-control" name="in_date" value="{{ $pur->in_date }}">
                    </div>

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Add jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>