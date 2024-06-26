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
                <form id="editCustomerForm{{ $cus->id }}" action="{{ route('customers.update', $cus->id) }}" method="POST">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Iterate through each edit modal and add event listener
        @foreach ($customers as $cus)
        (function() {
            const originalData = {
                customerName: document.querySelector('#editCustomerForm{{ $cus->id }} input[name="nama_customer"]').value,
                address: document.querySelector('#editCustomerForm{{ $cus->id }} input[name="address_customer"]').value,
                email: document.querySelector('#editCustomerForm{{ $cus->id }} input[name="email_customer"]').value,
                contact: document.querySelector('#editCustomerForm{{ $cus->id }} input[name="contact_customer"]').value,
            };


            // Reset form data when modal is closed
            const modalElement = document.getElementById('editCustomerModal{{ $cus->id }}');
            modalElement.addEventListener('hidden.bs.modal', function() {
                document.querySelector('#editCustomerForm{{ $cus->id }} input[name="nama_customer"]').value = originalData.customerName;
                document.querySelector('#editCustomerForm{{ $cus->id }} input[name="address_customer"]').value = originalData.address;
                document.querySelector('#editCustomerForm{{ $cus->id }} input[name="email_customer"]').value = originalData.email;
                document.querySelector('#editCustomerForm{{ $cus->id }} input[name="contact_customer"]').value = originalData.contact;
            });
        })();
        @endforeach
    });
</script>