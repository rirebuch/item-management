<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // app/Http/Controllers/BookController.php

    public function index(Request $request)
    {
        $query = $request->get('query');
    
        $books = Book::query()
            ->when($query, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%');
            })
            ->paginate(10);
    
        return view('books.index', compact('books')); // booksをビューに渡す
    }
}

