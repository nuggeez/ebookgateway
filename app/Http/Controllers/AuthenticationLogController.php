<?php

// Defines the namespace for this controller. It helps in organizing and grouping classes logically within the application.
namespace App\Http\Controllers;

// This class is used to handle HTTP requests.
use Illuminate\Http\Request;

// This class is used to handle HTTP responses.
use Illuminate\Http\Response;

// Imports the ApiResponser trait from the App\Traits namespace. This trait likely contains methods to standardize API responses.
use App\Traits\ApiResponser;

// Imports the AuthenticationLog model from the App\Models namespace. This model interacts with the 'authentication_logs' database table.
use App\Models\AuthenticationLog;

// Declares the AuthenticationLogController class, which extends Laravel's base Controller class.
class AuthenticationLogController extends Controller 
{
    use ApiResponser; // Uses the ApiResponser trait within this controller, giving access to its methods.

    private $request; // Declares a private property named $request of type Request. This property will hold an instance of the Request class.

    /**
     * Create a new controller instance
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request) // Defines the constructor method for this controller.
    {
        $this->request = $request; // Within the constructor, assigns the injected Request instance to the $request property. This allows the controller to use the request data.
    }

    /**
     * Return all authentication logs
     * @return Illuminate\Http\JsonResponse
     */
    public function getLogs() // Defines a public method named getLogs.
    {
        $logs = AuthenticationLog::all(); // Retrieves all records from the AuthenticationLog model.

        return response()->json($logs, 200); // Returns a JSON response with the logs and a 200 HTTP status code.
    }

    /**
     * Return the list of logs
     * @return Illuminate\Http\Response
     */
    public function index() // Defines a public method named index.
    {
        $logs = AuthenticationLog::all(); // Retrieves all records from the AuthenticationLog model.

        return $this->successResponse($logs); // Returns a successful response using the successResponse method from the ApiResponser trait.
    }

    /**
     * Add a new authentication log
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function add(Request $request) // Defines a public method named add that accepts an instance of the Request class as a parameter.
    {
        $rules = [
            'auth_id' => 'required|max:20', // Validation rules for the 'auth_id' parameter.
        ];

        $this->validate($request, $rules); // Validates the incoming request against the specified rules.

        $logs = AuthenticationLog::create($request->all()); // Creates a new record in the AuthenticationLog model with the request data.

        return $this->successResponse($logs, Response::HTTP_CREATED); // Returns a successful response with a 201 HTTP status code.
    }

    /**
     * Obtain and show one log
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function show($id) // Defines a public method named show that accepts an $id parameter.
    {
        $logs = AuthenticationLog::findOrFail($id); // Finds a record by $id in the AuthenticationLog model or fails with a 404 error.

        return $this->successResponse($logs); // Returns a successful response with the found log.
    }

    /**
     * Remove an existing log
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function delete($id) // Defines a public method named delete that accepts an $id parameter.
    {
        $logs = AuthenticationLog::findOrFail($id); // Finds a record by $id in the AuthenticationLog model or fails with a 404 error.

        $logs->delete(); // Deletes the found record.

        return $this->successResponse($logs); // Returns a successful response with the deleted log.
    }
}
