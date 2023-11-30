<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>
    <div class="container mt-2">
        <div class="d-flex justify-content-center">
            <h1>Library</h1>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary" onclick="openAddBookModal()">Add Book</button>
        </div>
        <label></label>
        <div id="books-list"></div>
        @include('create_book_modal')
        @include('edit_book_modal')
        <div class="mt-3">
            <ul class="pagination" id="pagination"></ul>
        </div>
    </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    const statusMap = {
        'read': 'Read',
        'not_read': 'Not read yet',
        'in_progress': 'In progress'
    };

    toastr.options = {
        positionClass: 'toast-top-center',
        timeOut: 1000,
    };

    $(document).ready(function () {
        loadBooks();
        $('#addBookModal').on('hidden.bs.modal', function () {
            clearValidationErrors();
        });
    });

    function openAddBookModal() {
        $('#addBookModal').modal('show');
    }

    function openEditBookModal(id) {
        $.ajax({
            url: '/api/mainpage/books/' + id,
            type: 'PUT',
            dataType: 'json',
            success: function (data) {
                let authors = Array.isArray(data.authors) ? data.authors.join(', ') : data.authors;

                $('#editBookModal #titleInputEdit').val(data.title);
                $('#editBookModal #authorsInputEdit').val(data.authors);
                $('#editBookModal #publisherInputEdit').val(data.publisher);
                $('#editBookModal #statusInputEdit').val(data.status);

                $('#editBookModal .btn-primary').attr('onclick', `updateBook(${id})`);

                $('#editBookModal').modal('show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function addBook() {
        let authorsInput = $('#authorsInput').val();
        let bookData = {
            title: $('#titleInput').val(),
            authors: Array.isArray(authorsInput) ? authorsInput.join(',') : authorsInput,
            publisher: $('#publisherInput').val(),
            status: $('#statusInput').val()
        };

        $.ajax({
            url: '/api/mainpage/books',
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(bookData),
            success: function (data) {
                loadBooks();
                $('#addBookModal').modal('hide');
                toastr.success('Book successfully added');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    displayValidationErrors(errors);
                } else {
                    console.log(xhr);
                }
            }
        });
    }

    function updateBook(id, currentPage) {
        let bookData = {
            title: $('#editBookModal #titleInputEdit').val(),
            authors: $('#editBookModal #authorsInputEdit').val(),
            publisher: $('#editBookModal #publisherInputEdit').val(),
            status: $('#editBookModal #statusInputEdit').val()
        };

        $.ajax({
            url: '/api/mainpage/books/' + id,
            type: 'PUT',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(bookData),
            success: function (data) {
                updateModalData(data);
                loadBooks(currentPage);
                $('#editBookModal').modal('hide');

                toastr.success('Book successfully updated');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    displayValidationErrors(errors, 'Edit');;
                } else {
                    console.log(xhr);
                }
            }
        });
    }

    function updateModalData(data) {
        $('#editBookModal #titleInputEdit').val(data.title);
        $('#editBookModal #authorsInputEdit').val(data.authors);
        $('#editBookModal #publisherInputEdit').val(data.publisher);
        $('#editBookModal #statusInputEdit').val(data.status);
    }

    function displayValidationErrors(errors, suffix = '') {
        $('.form-group').removeClass('has-error');
        $('.help-block').remove();

        $.each(errors, function (field, messages) {
            let inputField = $('#' + field + 'Input' + suffix);
            inputField.closest('.form-group').addClass('has-error');
            inputField.after('<span class="help-block text-danger" style="font-size: 12px;">' + messages.join(', ') + '</span>');
        });
    }

    function clearValidationErrors() {
        $('.form-group').removeClass('has-error');
        $('.help-block').remove();
    }

    function deleteBook(id, currentPage) {
        $.ajax({
            url: '/api/mainpage/books/' + id,
            type: 'DELETE',
            success: function (data) {
                loadBooks(currentPage);
                toastr.success('Book successfully removed');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function loadBooks(page) {
        $.ajax({
            url: '/api/mainpage/books?page=' + page,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#books-list').html('');

                if (data.data.length === 0) {
                    $('#books-list').append(`
                    <div class="frame d-flex align-items-center justify-content-center mx-auto" style="width: 45%;">
                        <div class="card-body">
                            <p class="card-text text-center">Here is an empty space... Press Add Button to declare your book</p>
                        </div>
                    </div>
                `);
                } else {
                    data.data.forEach(function (book) {
                        let authors = book.authors;
                        $('#books-list').append(`
                        <div class="frame d-flex align-items-center justify-content-center">
                             <div class="card-body">
                                <h5 class="card-title">Book title: ${book.title}</h5>
                                <p class="card-text">Authors: ${authors}</p>
                                <p class="card-text">Publisher: ${book.publisher}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card-text">Status: ${statusMap[book.status]}</p>
                                    <div class="btn-group">
                                        <div>
                                            <button class="btn btn-primary mr-2" onclick="openEditBookModal(${book.id})">Edit</button>
                                        </div>
                                        <div>
                                            <button class="btn btn-danger" onclick="deleteBook(${book.id}, ${data.current_page})">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label></label>
                    `);
                    });
                    pagination(data);
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function pagination(data) {
        $('#pagination').html('');
        if (data.last_page > 1) {
            for (let i = 1; i <= data.last_page; i++) {
                $('#pagination').append(`
                <li class="page-item ${data.current_page === i ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="loadBooks(${i})">${i}</a>
                </li>
            `);
            }
        }
    }
</script>
</html>
<style>
    .frame {
        background-color: rgba(200, 216, 230);
        border-radius: 10px;
        position: relative;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    body {
        background-color: #64e0fe;
    }
</style>
