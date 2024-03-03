<div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="BranchEditLabel">Branch</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('branch.update', ['branch' => $branch->id]) }}" method="POST">
        @method("PUT")
        @csrf
            <div class="modal-body">
                <label for="category" class="form-label">Branch category</label>
                @foreach($categories as $category)
                    <div class="form-check">
                        <input {{ $branch->categories->contains($category->id) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="category_id[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                        <label class="form-check-label" for="category{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach

                <label for="branch" class="form-label mt-3">Branch name</label>
                <input required type="text" class="form-control" id="branch" value="{{ $branch->name }}" name="name">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
