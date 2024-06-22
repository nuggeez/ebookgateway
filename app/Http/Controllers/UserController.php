<?php

// Defines the namespace for this controller. It helps in organizing and grouping classes logically within the application.
namespace App\Http\Controllers;

// These classes are used to handle HTTP responses and requests.
use Illuminate\Http\Response;
use Illuminate\Http\Request;

// Imports the ApiResponser trait from the App\Traits namespace. This trait likely contains methods to standardize API responses.
use App\Traits\ApiResponser;

// Imports the User model from the App\Models namespace. This model will interact with the users table in the database.
use App\Models\User;

// Declares the UserController class, which extends Laravel's base Controller class.
class UserController extends Controller {

    use ApiResponser; // Uses the ApiResponser trait within this controller, giving access to its methods.

    private $request; // Declares a private property named $request to hold the incoming request.

    /**
     * Create a new controller instance
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request) // Defines the constructor method for this controller.
    {
        $this->request = $request; // Within the constructor, assigns the injected Request instance to the $request property. This allows the controller to access request data.
    }

    /**
     * Get all users
     * @return Illuminate\Http\Response
     */
    public function getUsers() // Defines a public method named getUsers to retrieve all users.
    {
        $users = User::all(); // Fetches all users from the database.
        return response()->json($users, 200); // Returns the users in a JSON response with a 200 HTTP status code.
    }

    /**
     * Return the list of users
     * @return Illuminate\Http\Response
     */
    public function index() // Defines a public method named index to return the list of users.
    {
        $users = User::all(); // Fetches all users from the database.
        return $this->successResponse($users); // Returns a standardized success response using the successResponse method from the ApiResponser trait.
    }

    /**
     * Add a new user
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function add(Request $request) // Defines a public method named add to add a new user.
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]; // Defines validation rules for the request data.

        $this->validate($request, $rules); // Validates the incoming request against the defined rules.

        $user = User::create($request->all()); // Creates a new user with the validated request data.

        return $this->successResponse($user, Response::HTTP_CREATED); // Returns a standardized success response with the created user's data and a 201 HTTP status code.
    }

    /**
     * Obtains and show one user
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function show($id) // Defines a public method named show to get and display a user by ID.
    {
        $user = User::findOrFail($id); // Fetches the user by ID or throws a 404 exception if not found.

        return $this->successResponse($user); // Returns a standardized success response with the user's data.
    }

    /**
     * Update an existing user
     * @param Request $request
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id) // Defines a public method named update to update an existing user.
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'max:255',
            'password' => 'max:255',
        ]; // Defines validation rules for the request data.

        $this->validate($request, $rules); // Validates the incoming request against the defined rules.

        $user = User::findOrFail($id); // Fetches the user by ID or throws a 404 exception if not found.

        $user->fill($request->all()); // Fills the user model with the request data.

        // if no changes happen
        if ($user->isClean()) { // Checks if any attributes have been modified.
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY); // Returns an error response if no attributes have been modified.
        }

        $user->save(); // Saves the updated user data to the database.

        return $this->successResponse($user); // Returns a standardized success response with the updated user's data.
    }

    /**
     * Remove an existing user
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function delete($id) // Defines a public method named delete to remove an existing user.
    {
        $user = User::findOrFail($id); // Fetches the user by ID or throws a 404 exception if not found.

        $user->delete(); // Deletes the user from the database.

        return $this->successResponse($user); // Returns a standardized success response with the deleted user's data.
    }
}
