 
# mainpage.blade.php

  1. Libraries and Frameworks:
The code uses Bootstrap for styling and layout.
jQuery is utilized for simplifying JavaScript interactions, especially with AJAX requests and handling DOM manipulation.

  2. Styling:
The background color of the entire page (<body>) is set to a light blue color (#64e0fe).

  3. Modals:
There are two modals: one for adding a new book (#addBookModal) and another for editing an existing book (#editBookModal).
Both modals have form elements for entering book details such as title, authors, publisher, and status.

  4. Book Display:
Book information is displayed in cards within frames.
Each card includes the book's title, authors, publisher, and status.
There are "Edit" and "Remove" buttons to modify or delete the corresponding book.

  5. AJAX Requests:
AJAX requests are used to asynchronously communicate with a server-side API.
The loadBooks, addBook, updateBook, and deleteBook functions handle data retrieval, addition, modification, and deletion,
respectively.

  6. Pagination:
Pagination is implemented to navigate through the list of books.

  7. Toastr Notifications:
Toastr is employed for displaying notifications, such as success messages after adding or updating a book.

  8. JavaScript:
The JavaScript code initializes the application, sets up event listeners, and manages the interaction between the UI and 
server through AJAX requests.

  10. Responsive Design:
The application uses Bootstrap classes for responsive design, ensuring a good user experience across different devices.
 
  11. Data Binding:
Data from the server is dynamically bound to the UI, ensuring that changes are reflected without needing a full page reload.

# BookController.php

  1. Add Book (addBook method):
Validates the incoming request data using Laravel's validation.
Creates a new Book model instance with the validated data.
Saves the new book to the database.
Returns a JSON response with the newly created book and a status code of 201 (Created) on success.
If validation fails, it returns a JSON response with validation errors and a status code of 422 (Unprocessable Entity).

  2. Update Book (updateBook method):
Validates the incoming request data using Laravel's validation.
Retrieves the existing book by its ID.
If the book is not found, it returns a JSON response with a 404 status code.
Updates the book's attributes with the new data or keeps the existing values if the data is not provided.
Returns a JSON response with the updated book and a status code of 200 (OK) on success.
If validation fails, it returns a JSON response with validation errors and a status code of 422 (Unprocessable Entity).

  3. Delete Book (deleteBook method):
Finds the book by its ID.
If the book is not found, it returns a JSON response with a 404 status code.
Deletes the book from the database.
Returns a JSON response with a success message and a status code of 200 (OK) on success.

  4. Get Books (getBooks method):
Retrieves a paginated list of books from the database (5 books per page).
Returns a JSON response with the paginated list of books.

# api.php

   1. POST /mainpage/books:
Maps to the addBook method in the BookController.
Used for adding a new book to the library.
Accepts a POST request.

   2. PUT /mainpage/books/{id}:
Maps to the updateBook method in the BookController.
Used for updating an existing book in the library by its ID.
Accepts a PUT request.

   3. DELETE /mainpage/books/{id}:
Maps to the deleteBook method in the BookController.
Used for deleting an existing book in the library by its ID.
Accepts a DELETE request.

   4. GET /mainpage/books:
Maps to the getBooks method in the BookController.
Used for retrieving a paginated list of books from the library.
Accepts a GET request.

# web.php

Consist mapping to the main page of website.

# Book.php

1. Table Association: The Book model is associated with a table in the database.

2. Mass Assignment: The protected $fillable property specifies which attributes are mass-assignable, allowing them to be 
used in mass assignment operations like create.

3. Timestamps: By default, Laravel assumes the table associated with this model has created_at and updated_at columns 
to manage timestamps. This is facilitated by the HasFactory trait.

4. Attributes: The model has attributes: title, authors, publisher, and status.

# books table

id: Auto-incremental primary key.

title: A string column to store the book title.

authors: A string column to store the book authors.

publisher: A string column to store the publisher of the book.

status: An enumeration column with possible values 'read', 'not_read', and 'in_progress', 
defaulting to 'not_read'.

timestamps: Laravel timestamps for created_at and updated_at
