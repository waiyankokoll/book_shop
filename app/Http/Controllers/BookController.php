<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('book.list', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view("Book.create", compact("categories", "authors"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bookName' => 'required|string|min:3|max:255',
            'bookAuthor' => 'required|numeric|exists:authors,id',
            'bookPrice' => 'required|numeric',
            'bookCategory' => 'required|numeric|exists:categories,id',
            'bookImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bookDescription' => 'required|string|min:10|max:1000',

        ]);

        $book = new Book();
        $book->name = $request->bookName;
        $book->author_id = $request->bookAuthor;
        $book->price = $request->bookPrice;
        $book->category_id = $request->bookCategory;
        $book->description = $request->bookDescription;

        if ($request->hasFile('bookImage')) {
            $image = $request->file('bookImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = public_path('images/books');
            $image->move($uploadPath, $imageName);
            $book->image = 'images/books/' . $imageName;
        }

        $book->save();
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view("Book.deail", compact("book"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();
        return view("Book.edit", compact("book", "categories", "authors"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        

        $request->validate([
            'bookName' => 'required|string|min:3|max:255',
            'bookAuthor' => 'required|numeric|exists:authors,id',
            'bookPrice' => 'required|numeric',
            'bookCategory' => 'required|numeric|exists:categories,id',
            'bookImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bookDescription' => 'required|string|min:10|max:1000',
        ]);
        // Update the book details
       if ($request->hasFile('bookImage')) {
            // Delete the old image if it exists
            if ($book->image && file_exists(public_path($book->image))) {
                unlink(public_path($book->image));
            }
        }
        
        $book->update([
            'name' => $request->bookName,
            'author_id' => $request->bookAuthor,
            'price' => $request->bookPrice,
            'category_id' => $request->bookCategory,
            'description' => $request->bookDescription,
            'image' => $request->hasFile('bookImage')
                ? (function () use ($request) {
                    $image = $request->file('bookImage');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/books'), $imageName);
                    return 'images/books/' . $imageName;
                })()
                : $book->image,

        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route("books.index")->with("success", "Book deleted successfully.");
    }
}
