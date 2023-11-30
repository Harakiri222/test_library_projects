<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="titleInput">Book title: </label>
                    <input type="text" class="form-control" id="titleInput">
                </div>
                <div class="form-group">
                    <label for="authorsInput">Authors: </label>
                    <input type="text" class="form-control" id="authorsInput">
                </div>
                <div class="form-group">
                    <label for="publisherInput">Publisher: </label>
                    <input type="text" class="form-control" id="publisherInput">
                </div>
                <div class="form-group">
                    <label for="statusInput">Status: </label>
                    <select class="form-control" id="statusInput">
                        <option value="read">Read</option>
                        <option value="not_read">Not read yet</option>
                        <option value="in_progress">In progress</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addBook()">Confirm</button>
            </div>
        </div>
    </div>
</div>
