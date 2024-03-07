<div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Branch</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('branch.store') }}" method="POST">
        @csrf
            <div class="modal-body">
                <label for="category" class="form-label">Tag category</label>
                @foreach($categories->where('type', 'like', '1') as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="category_id[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                        <label class="form-check-label" for="category{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach

                <label for="branch" class="form-label mt-3">Tag name</label>
                <input required type="text" class="form-control" id="branch" name="name">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
