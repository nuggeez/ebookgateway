<?php

//Defines the namespace for this controller. It helps in organizing and grouping classes logically within the application.
namespace App\Http\Controllers;

//This class is used to handle HTTP requests.
use Illuminate\Http\Request;

//Imports the AllBooksApiService class from the App\Services namespace. This service will be used to interact with an external API to fetch book details.
use App\Services\AllBooksApiService;

//Imports the ApiResponser trait from the App\Traits namespace. This trait likely contains methods to standardize API responses.
use App\Traits\ApiResponser;

//Declares the AllBooksApiController class, which extends Laravel's base Controller class.
class AllBooksApiController extends Controller
{
    use ApiResponser; // Uses the ApiResponser trait within this controller, giving access to its methods.

    /**
     * The service to consume the All Books API service
     * @var AllBooksApiService
     */
    public $allBooksApiService; // Declares a public property named $allBooksApiService of type AllBooksApiService. This property will hold an instance of the AllBooksApiService class.

    /**
     * Create a new controller instance
     * @param AllBooksApiService $allBooksApiService
     * @return void
     */
    public function __construct(AllBooksApiService $allBooksApiService) // Defines the constructor method for this controller.
    {
        $this->allBooksApiService = $allBooksApiService; // Within the constructor, assigns the injected AllBooksApiService instance to the $allBooksApiService property. This allows the controller to use the service.
    }

    /**
     * Return the book details by title
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function search(Request $request) // Defines a public method named search that accepts an instance of the Request class as a parameter.
    {
        $this->validate($request, [
            'title' => 'required|string', // Validates the incoming request to ensure it contains a 'title' parameter, which must be a required string.
        ]);

        $title = $request->input('title'); // Retrieves the 'title' parameter from the request and assigns it to the $title variable.

        try {
            // Obtain book details from AllBooksApiService
            $data = $this->allBooksApiService->obtainBook($title);
            return $this->successResponse($data);
        } catch (\Exception $e) {
            // Handle any exceptions
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
