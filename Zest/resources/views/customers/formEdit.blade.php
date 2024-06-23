<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>

<!-- Edit Customer Modal -->
@foreach ($customer as $cus)
<div class="modal fade" id="editCustomerModal{{ $cus->id }}" tabindex="-1" aria-labelledby="editCustomerModalLabel{{ $cus->id }}" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel{{ $cus->id }}">Edit Customer Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customers.update', $cus->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="nama_customer" value="{{ $cus->nama_customer }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Item</label>
                        <input type="text" class="form-control" name="item_customer" value="{{ $cus->item_customer }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Item Quantity</label>
                        <input type="number" class="form-control" name="quantity_customer" value="{{ $cus->quantity_customer }}">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach