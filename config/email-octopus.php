<?php

return [

    /*
     * Your Email Octopus API key, check the docs on how to set it up:
     * https://help.emailoctopus.com/article/165-how-to-create-and-delete-api-keys
     */
    'api_key' => env('EMAIL_OCTOPUS_API_KEY', ''),

    /*
     * The base URI of the API, for most cases default is fine and there is no need to set this variable
     */
    'base_uri' => env('EMAIL_OCTOPUS_BASE_URI', 'https://emailoctopus.com/api/1.6/'),

    /*
     * Specify the maximum number of seconds to wait for a response.
     */
    'timeout' => env('EMAIL_OCTOPUS_TIMEOUT', 30),

    /*
     * Specify the maximum number of seconds to wait while trying to connect to a server.
     */
    'connect_timeout' => env('EMAIL_OCTOPUS_CONNECT_TIMEOUT', 3),
];
