  <!-- Modal -->
<div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tag</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ route('tag.store') }}" method="POST">
        @csrf
            <div class="modal-body">
                @if (isset($categories) && !empty($categories))
                    <label for="category" class="form-label">Tag category</label>
                    <select required name="category_id" class="form-select" aria-label="Default select example">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                @else
                    <input name="category_id" type="hidden" value="{{ $slot }}" class="form-select" aria-label="Default select example">   
                @endif

                <label for="tagName" class="form-label mt-3">Tag name</label>
                <input required type="text" class="form-control" id="tagName" name="name">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
