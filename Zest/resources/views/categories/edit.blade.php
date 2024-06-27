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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm{{ $cat->id }}" action="{{ route('categories.update', $cat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="kategori" id="kategori{{ $cat->id }}" value="{{ $cat->kategori }}" required>
                        <div id="category-error{{ $cat->id }}" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="jumlah" value="{{ $cat->jumlah }}">
                    </div>

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="submitEditCategoryBtn{{ $cat->id }}" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const existingCategories = @json($category->pluck('kategori'));

        @foreach ($category as $cat)
        const categoryInput{{ $cat->id }} = document.getElementById('kategori{{ $cat->id }}');
        const categoryError{{ $cat->id }} = document.getElementById('category-error{{ $cat->id }}');
        const submitEditCategoryBtn{{ $cat->id }} = document.getElementById('submitEditCategoryBtn{{ $cat->id }}');

        categoryInput{{ $cat->id }}.addEventListener('input', function() {
            validateCategoryName{{ $cat->id }}();
        });

        function validateCategoryName{{ $cat->id }}() {
            const categoryName = categoryInput{{ $cat->id }}.value.trim().toLowerCase();
            const categoryExists = existingCategories.some(category => category.toLowerCase() === categoryName && categoryName !== '{{ $cat->kategori }}'.toLowerCase());

            if (categoryExists) {
                categoryError{{ $cat->id }}.textContent = 'Category name already exists.';
                categoryInput{{ $cat->id }}.classList.add('is-invalid');
                submitEditCategoryBtn{{ $cat->id }}.disabled = true;
            } else {
                categoryError{{ $cat->id }}.textContent = '';
                categoryInput{{ $cat->id }}.classList.remove('is-invalid');
                submitEditCategoryBtn{{ $cat->id }}.disabled = false;
            }
        }

        // Clear form on modal close
        $('#editCategoryModal{{ $cat->id }}').on('hidden.bs.modal', function () {
            categoryInput{{ $cat->id }}.value = '{{ $cat->kategori }}';
            categoryError{{ $cat->id }}.textContent = '';
            categoryInput{{ $cat->id }}.classList.remove('is-invalid');
            submitEditCategoryBtn{{ $cat->id }}.disabled = false;
        });

        // Trigger validation on form submit
        document.getElementById('editCategoryForm{{ $cat->id }}').addEventListener('submit', function(event) {
            validateCategoryName{{ $cat->id }}();
            if (submitEditCategoryBtn{{ $cat->id }}.disabled) {
                event.preventDefault();
            }
        });
        @endforeach
    });
</script>