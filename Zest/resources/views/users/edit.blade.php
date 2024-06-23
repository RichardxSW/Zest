<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>

@foreach ($users as $user)
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User {{ $user-> name }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">User name</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ $user->email }}" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div> -->
                    <!-- <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div> -->
                    <div class="mb-3">
                    <label class="form-label">Role</label>
                        <select class="form-control" name="role" required>
                            <option value="" disabled selected>Select a role</option>
                                <option value="Stock_Manager" {{ $user->role == 'Stock_Manager' ? 'selected' : '' }}>Stock Manager</option>
                                <option value="Super_Admin" {{ $user->role == 'Super_Admin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="Purchasing_Staff" {{ $user->role == 'Purchasing_Staff' ? 'selected' : '' }}>Purchasing Staff</option>
                                <option value="Marketing_Staff" {{ $user->role == 'Marketing_Staff' ? 'selected' : '' }}>Marketing Staff</option>
                        </select>
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="kategori_produk" value="{{ $user->kategori_produk }}">
                    </div> -->
                    <!-- <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div> -->

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach