<?php

// Defines the namespace for this trait. Traits are reusable code units in PHP that can be used by classes in different hierarchies.
namespace App\Traits;

// Imports the Response class from Illuminate\Http for HTTP response handling.
use Illuminate\Http\Response;

// Defines the ApiResponser trait.
trait ApiResponser
{
    /**
     * Build success response.
     *
     * @param string|array $data The data to be returned in the response.
     * @param int $code The HTTP status code (default is 200 OK).
     * @return Illuminate\Http\Response The HTTP response object.
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        // Returns a JSON response with the provided data and status code, with Content-Type header set to application/json.
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * Build valid response.
     *
     * @param string|array $data The data to be returned in the response.
     * @param int $code The HTTP status code (default is 200 OK).
     * @return Illuminate\Http\JsonResponse The JSON response object.
     */
    public function validResponse($data, $code = Response::HTTP_OK)
    {
        // Returns a JSON response with 'data' key containing the provided data and the status code.
        return response()->json(['data' => $data], $code);
    }

    /**
     * Build error response.
     *
     * @param string|array $message The error message or array of errors.
     * @param int $code The HTTP status code of the error.
     * @return Illuminate\Http\JsonResponse The JSON response object.
     */
    public function errorResponse($message, $code)
    {
        // Returns a JSON response with 'error' key containing the error message, 'code' key containing the status code, and the status code itself.
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /**
     * Build error message response.
     *
     * @param string|array $message The error message or array of errors.
     * @param int $code The HTTP status code of the error.
     * @return Illuminate\Http\Response The HTTP response object.
     */
    public function errorMessage($message, $code)
    {
        // Returns a plain text response with the error message and the status code, with Content-Type header set to application/json.
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}
