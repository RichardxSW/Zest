<!-- Edit Customer Modal -->
@foreach ($customers as $cus)
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
                        <input type="text" class="form-control" name="nama_customer" value="{{ $cus->nama_customer }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address_customer" value="{{ $cus->address_customer }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email_customer" value="{{ $cus->email_customer }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact</label>
                        <input type="text" class="form-control" name="contact_customer" value="{{ $cus->contact_customer }}">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach