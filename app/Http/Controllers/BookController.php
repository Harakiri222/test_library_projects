<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function addBook(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string',
                'authors' => 'required|string',
                'publisher' => 'required|string',
                'status' => 'in:read,not_read,in_progress',
            ]);

            $book = new Book([
                'title' => $request->input('title'),
                'authors' => $request->input('authors'),
                'publisher' => $request->input('publisher'),
                'status' => $request->input('status', 'not_read')
            ]);

            $book->save();

            return response()->json($book, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function updateBook(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'string',
                'authors' => 'string',
                'publisher' => 'string',
                'status' => 'in:read,not_read,in_progress'
            ]);

            $book = Book::find($id);

            if (!$book) {
                return response()->json(['message' => 'Book not found'], 404);
            }

            $book->update([
                'title' => $request->input('title', $book->title),
                'authors' => $request->input('authors', $book->authors),
                'publisher' => $request->input('publisher', $book->publisher),
                'status' => $request->input('status', $book->status),
            ]);

            return response()->json($book, 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found for id ' . $id], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted'], 200);
    }

    public function getBooks()
    {
        $books = Book::paginate(5);
        return response()->json($books);
    }
}
