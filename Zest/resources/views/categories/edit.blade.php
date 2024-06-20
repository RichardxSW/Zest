<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>

@foreach ($category as $cat)
<div class="modal fade" id="editCategoryModal{{ $cat->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel{{ $cat->id }}" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel{{ $cat->id }}">Edit Category </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.update', $cat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="kategori" value="{{ $cat->kategori }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="jumlah" value="{{ $cat->jumlah }}">
                    </div>
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