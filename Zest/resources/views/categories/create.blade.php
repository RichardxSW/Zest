<style>
    .mb-3 {
        margin-bottom: 30px !important;
    }
</style>

<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered" role="document">
        <div class="modal-content custom-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm" action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="kategori" id="kategori" required>
                        <div id="category-error" class="invalid-feedback"></div>
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="submitCategoryBtn" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryInput = document.getElementById('kategori');
        const categoryError = document.getElementById('category-error');
        const submitCategoryBtn = document.getElementById('submitCategoryBtn');
        const existingCategories = @json($category->pluck('kategori'));

        categoryInput.addEventListener('input', validateCategoryName);

        function validateCategoryName() {
            const categoryName = categoryInput.value.trim().toLowerCase();
            const categoryExists = existingCategories.some(category => category.toLowerCase() === categoryName);

            if (categoryExists) {
                categoryError.textContent = 'Category name already exists.';
                categoryInput.classList.add('is-invalid');
                submitCategoryBtn.disabled = true;
            } else {
                categoryError.textContent = '';
                categoryInput.classList.remove('is-invalid');
                submitCategoryBtn.disabled = false;
            }
        }

        // Clear form on modal close
        $('#addCategoryModal').on('hidden.bs.modal', function () {
            categoryInput.value = '';
            categoryError.textContent = '';
            categoryInput.classList.remove('is-invalid');
            submitCategoryBtn.disabled = false;
        });

        // Trigger validation on form submit
        document.getElementById('addCategoryForm').addEventListener('submit', function(event) {
            validateCategoryName();
            if (submitCategoryBtn.disabled) {
                event.preventDefault();
            }
        });
    });
</script>