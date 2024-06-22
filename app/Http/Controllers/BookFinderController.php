<?php

// Defines the namespace for this controller. It helps in organizing and grouping classes logically within the application.
namespace App\Http\Controllers;

// This class is used to handle HTTP requests.
use Illuminate\Http\Request;

// Imports the BookFinderService class from the App\Services namespace. This service will be used to interact with an external API to search for books.
use App\Services\BookFinderService;

// Imports the ApiResponser trait from the App\Traits namespace. This trait likely contains methods to standardize API responses.
use App\Traits\ApiResponser;

// Declares the BookFinderController class, which extends Laravel's base Controller class.
class BookFinderController extends Controller
{
    use ApiResponser; // Uses the ApiResponser trait within this controller, giving access to its methods.

    /**
     * The service to consume the Book Finder service
     * @var BookFinderService
     */
    public $bookFinderService; // Declares a public property named $bookFinderService of type BookFinderService. This property will hold an instance of the BookFinderService class.

    /**
     * Create a new controller instance
     * @param BookFinderService $bookFinderService
     * @return void
     */
    public function __construct(BookFinderService $bookFinderService) // Defines the constructor method for this controller.
    {
        $this->bookFinderService = $bookFinderService; // Within the constructor, assigns the injected BookFinderService instance to the $bookFinderService property. This allows the controller to use the service.
    }

    /**
     * Search for books using Book Finder API
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function searchBooks(Request $request) // Defines a public method named searchBooks that accepts an instance of the Request class as a parameter.
    {
        $series = $request->query('series'); // Retrieves the 'series' parameter from the query string of the request.
        $book_type = $request->query('book_type'); // Retrieves the 'book_type' parameter from the query string of the request.
        $author = $request->query('author'); // Retrieves the 'author' parameter from the query string of the request.

        try {
            // Call the Book Finder service to search for books
            $data = $this->bookFinderService->searchBooks($series, $book_type, $author); // Calls the searchBooks method on the BookFinderService instance, passing the query parameters. The result is assigned to the $data variable.
            return $this->successResponse($data); // Returns a successful response using the successResponse method from the ApiResponser trait, passing the $data.
        } catch (\Exception $e) {
            // Handle any exceptions
            return $this->errorResponse($e->getMessage(), 500); // If an exception occurs, returns an error response with the exception message and a 500 HTTP status code using the errorResponse method from the ApiResponser trait.
        }
    }
}
