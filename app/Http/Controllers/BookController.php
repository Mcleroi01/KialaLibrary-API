<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     /**
 * @OA\Get(
 *      path="/books",
 *      operationId="getBooksList",
 *      tags={"Book"},
 *      summary="Get list of books",
 *      description="Returns list of books",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              type="array",
 *              @OA\Items(ref="#/components/schemas/Book")
 *          )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 */




    public function index()
    {
        return Book::all();
    }

    /**
 * @OA\Post(
 *     path="/books",
 *     summary="Create a new book",
 *     tags={"Book"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "author", "year"},
 *             @OA\Property(property="title", type="string", example="Clean Code"),
 *             @OA\Property(property="author", type="string", example="Robert C. Martin"),
 *             @OA\Property(property="genre", type="string", example="Programming"),
 *             @OA\Property(property="year", type="integer", example=2024)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Book created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Book")
 *     )
 * )
 */


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'genre' => 'nullable|string',
            'year' => 'required|digits:4|integer',
        ]);

        return Book::create($validated);
    }

    /**
 * @OA\Get(
 *     path="/books/{id}",
 *     summary="Get book by ID",
 *     tags={"Book"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the book",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Book found",
 *         @OA\JsonContent(ref="#/components/schemas/Book")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Book not found"
 *     )
 * )
 */


    public function show(Book $book)
    {
        return $book;
    }

    /**
 * @OA\Put(
 *     path="/books/{id}",
 *     summary="Update a book",
 *     tags={"Book"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the book to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Refatoração"),
 *             @OA\Property(property="author", type="string", example="Martin Fowler"),
 *             @OA\Property(property="genre", type="string", example="Engenharia de Software"),
 *             @OA\Property(property="year", type="integer", example=2023),
 *             @OA\Property(property="available", type="boolean", example=true)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Book updated successfully"
 *     )
 * )
 */


    public function update(Request $request, Book $book)
    {
        $book->update($request->only(['title', 'author', 'genre', 'year', 'available']));
        return response()->json(['message' => 'Book updated']);
    }



    /**
 * @OA\Delete(
 *     path="/books/{id}",
 *     summary="Delete a book",
 *     tags={"Book"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the book to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Book deleted successfully"
 *     )
 * )
 */


    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Book deleted']);
    }

    /**
 * @OA\Get(
 *     path="/books/search",
 *     summary="Search books by title or author",
 *     tags={"Book"},
 *     @OA\Parameter(
 *         name="q",
 *         in="query",
 *         required=false,
 *         description="Search term for title or author",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Matching books",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Book"))
 *     )
 * )
 */


    public function search(Request $request)
{
    $query = Book::query();

    if ($request->has('q')) {
        $search = $request->get('q');
        $query->where('title', 'LIKE', "%{$search}%")
              ->orWhere('author', 'LIKE', "%{$search}%");
    }

    return $query->get();
}

/**
 * @OA\Get(
 *     path="/books/available",
 *     summary="Get all available books",
 *     tags={"Book"},
 *     @OA\Response(
 *         response=200,
 *         description="List of available books",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Book"))
 *     )
 * )
 */

    public function availableBooks()
    {
        return Book::where('available', true)->get();
    }

    /**
 * @OA\Get(
 *     path="/books/unavailable",
 *     summary="Get all unavailable books",
 *     tags={"Book"},
 *     @OA\Response(
 *         response=200,
 *         description="List of unavailable books",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Book"))
 *     )
 * )
 */


    public function unavailableBooks()
    {
        return Book::where('available', false)->get();
    }

    /**
 * @OA\Get(
 *     path="/books/genre/{genre}",
 *     summary="Get books by genre",
 *     tags={"Book"},
 *     @OA\Parameter(
 *         name="genre",
 *         in="path",
 *         required=true,
 *         description="Genre to filter",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Books of the given genre",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Book"))
 *     )
 * )
 */


    public function booksByGenre($genre)
    {
        return Book::where('genre', $genre)->get();
    }

    /**
 * @OA\Get(
 *     path="/books/author/{author}",
 *     summary="Get books by author",
 *     tags={"Book"},
 *     @OA\Parameter(
 *         name="author",
 *         in="path",
 *         required=true,
 *         description="Author name to filter",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Books by the given author",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Book"))
 *     )
 * )
 */


    public function booksByAuthor($author)
    {
        return Book::where('author', $author)->get();
    }

    /**
 * @OA\Get(
 *     path="/books/year/{year}",
 *     summary="Get books by publication year",
 *     tags={"Book"},
 *     @OA\Parameter(
 *         name="year",
 *         in="path",
 *         required=true,
 *         description="Year to filter",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Books published in the given year",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Book"))
 *     )
 * )
 */


    public function booksByYear($year)
    {
        return Book::where('year', $year)->get();
    }

    /**
 * @OA\Get(
 *     path="/books/stats",
 *     summary="Get book statistics",
 *     tags={"Book"},
 *     @OA\Response(
 *         response=200,
 *         description="Book stats",
 *         @OA\JsonContent(
 *             @OA\Property(property="total", type="integer", example=120),
 *             @OA\Property(property="available", type="integer", example=97),
 *             @OA\Property(
 *                 property="genres",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="genre", type="string", example="Fiction"),
 *                     @OA\Property(property="total", type="integer", example=30)
 *                 )
 *             )
 *         )
 *     )
 * )
 */


    public function stats()
{
    return [
        'total' => Book::count(),
        'available' => Book::where('available', true)->count(),
        'genres' => Book::select('genre')
                        ->groupBy('genre')
                        ->selectRaw('count(*) as total')
                        ->get()
    ];
}


    public function booksByTitle($title)
    {
        return Book::where('title', 'LIKE', "%{$title}%")->get();
    }


    /**
 * @OA\Get(
 *     path="/books/latest",
 *     summary="Get latest added books",
 *     tags={"Book"},
 *     @OA\Response(
 *         response=200,
 *         description="Latest books",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Book"))
 *     )
 * )
 */
    public function latestBooks()
    {
        return Book::latest()->take(5)->get();
    }


}