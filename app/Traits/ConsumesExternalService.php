<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{
    /**
     * Send a request to any service
     * @return string
     */
    public function performRequest($method, $requestUrl, $form_params = [], $headers = [])
    {
        // Create a new Guzzle HTTP client instance with base URI provided by the calling class.
        $client = new Client(['base_uri' => $this->baseUri]);

        try {
            // Attempt to send an HTTP request to the specified URL with given parameters and headers.
            $response = $client->request($method, $requestUrl, [
                'form_params' => $form_params,
                'headers' => $headers,
            ]);

            // Return the response body contents as a string.
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            // Catch any exceptions that occur during the request and throw a new exception with the error message.
            throw new \Exception($e->getMessage());
        }

        // The following code is unreachable because of the preceding 'return' statement inside the 'try' block.
        // It seems to be a mistake and should be removed or placed before the return statement if intended to execute.
        if(isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        // Perform the request (method, url, form parameters, headers)
        $response = $client->request($method, $requestUrl, ['form_params' =>
            $form_params, 'headers' => $headers]);

        // Return the response body contents
        return $response->getBody()->getContents();
    }
}
