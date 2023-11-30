<div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="titleInputEdit">Book title: </label>
                    <input type="text" class="form-control" id="titleInputEdit">
                </div>
                <div class="form-group">
                    <label for="authorsInputEdit">Authors: </label>
                    <input type="text" class="form-control" id="authorsInputEdit">
                </div>
                <div class="form-group">
                    <label for="publisherInputEdit">Publisher: </label>
                    <input type="text" class="form-control" id="publisherInputEdit">
                </div>
                <div class="form-group">
                    <label for="statusInputEdit">Status: </label>
                    <select class="form-control" id="statusInputEdit">
                        <option value="read">Read</option>
                        <option value="not_read">Not read yet</option>
                        <option value="in_progress">In progress</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateBook()">Confirm</button>
            </div>
        </div>
    </div>
</div>
