  <!-- Modal -->
<div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="categortCreateLabel">Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
            <div class="modal-body">
                <label for="categoryName" class="form-label mt-3">Category name</label>
                <input required type="text" class="form-control" id="categoryName" name="name">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
