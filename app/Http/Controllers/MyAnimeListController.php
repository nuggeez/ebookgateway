<?php

// Defines the namespace for this controller. It helps in organizing and grouping classes logically within the application.
namespace App\Http\Controllers;

// This class is used to handle HTTP requests.
use Illuminate\Http\Request;

// Imports the MyAnimeListService class from the App\Services namespace. This service will be used to interact with an external API to fetch manga recommendations and details.
use App\Services\MyAnimeListService;

// Imports the ApiResponser trait from the App\Traits namespace. This trait likely contains methods to standardize API responses.
use App\Traits\ApiResponser;

// Declares the MyAnimeListController class, which extends Laravel's base Controller class.
class MyAnimeListController extends Controller
{
    use ApiResponser; // Uses the ApiResponser trait within this controller, giving access to its methods.

    /**
     * The service to consume the MyAnimeList service
     * @var MyAnimeListService
     */
    public $myAnimeListService; // Declares a public property named $myAnimeListService of type MyAnimeListService. This property will hold an instance of the MyAnimeListService class.

    /**
     * Create a new controller instance
     * @param MyAnimeListService $myAnimeListService
     * @return void
     */
    public function __construct(MyAnimeListService $myAnimeListService) // Defines the constructor method for this controller.
    {
        $this->myAnimeListService = $myAnimeListService; // Within the constructor, assigns the injected MyAnimeListService instance to the $myAnimeListService property. This allows the controller to use the service.
    }

    /**
     * Get manga recommendations from MyAnimeList API
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function getMangaRecommendations(Request $request) // Defines a public method named getMangaRecommendations that accepts an instance of the Request class as a parameter.
    {
        $page = $request->query('page', 1); // Retrieves the 'page' parameter from the query string of the request, defaulting to 1 if not provided.

        try {
            // Call the MyAnimeList service to get manga recommendations
            $data = $this->myAnimeListService->getMangaRecommendations($page); // Calls the getMangaRecommendations method on the MyAnimeListService instance, passing the page parameter. The result is assigned to the $data variable.
            return $this->successResponse($data); // Returns a successful response using the successResponse method from the ApiResponser trait, passing the $data.
        } catch (\Exception $e) {
            // Handle any exceptions
            return $this->errorResponse($e->getMessage(), 500); // If an exception occurs, returns an error response with the exception message and a 500 HTTP status code using the errorResponse method from the ApiResponser trait.
        }
    }

    /**
     * Get manga details from MyAnimeList API by ID
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function getMangaDetails($id) // Defines a public method named getMangaDetails that accepts an $id parameter.
    {
        try {
            // Call the MyAnimeList service to get manga details by ID
            $data = $this->myAnimeListService->getMangaDetailsById($id); // Calls the getMangaDetailsById method on the MyAnimeListService instance, passing the ID. The result is assigned to the $data variable.
            return $this->successResponse($data); // Returns a successful response using the successResponse method from the ApiResponser trait, passing the $data.
        } catch (\Exception $e) {
            // Handle any exceptions
            return $this->errorResponse($e->getMessage(), 500); // If an exception occurs, returns an error response with the exception message and a 500 HTTP status code using the errorResponse method from the ApiResponser trait.
        }
    }
}
