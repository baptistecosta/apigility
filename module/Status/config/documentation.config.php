<?php
return array(
    'Status\\V1\\Rpc\\Ping\\Controller' => array(
        'GET' => array(
            'description' => 'Ping the API for availability and receive a timestamp for acknowledgement.',
            'request' => null,
            'response' => '{
    "ack": "Acknowledge the request with a timestamp"
}',
        ),
        'description' => 'Ping the API for availability.',
    ),
    'Status\\V1\\Rest\\Status\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Retrieve a paginated list of status messages.',
                'request' => null,
                'response' => null,
            ),
            'POST' => array(
                'description' => 'Create a new status messages.',
                'request' => null,
                'response' => null,
            ),
            'description' => 'Manipulate lists of status messages.',
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Retrieve a status message.',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/status[/:status_id]"
       }
   }
   "message": "A status message of no more than 140 characters.",
   "user": "The user submitting the status message.",
   "timestamp": "The timestamp when the status message was last modified."
}',
            ),
            'PATCH' => array(
                'description' => 'Update a status message.',
                'request' => '{
   "message": "A status message of no more than 140 characters.",
   "user": "The user submitting the status message.",
   "timestamp": "The timestamp when the status message was last modified."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/status[/:status_id]"
       }
   }
   "message": "A status message of no more than 140 characters.",
   "user": "The user submitting the status message.",
   "timestamp": "The timestamp when the status message was last modified."
}',
            ),
            'PUT' => array(
                'description' => 'Replace a status message.',
                'request' => '{
   "message": "A status message of no more than 140 characters.",
   "user": "The user submitting the status message.",
   "timestamp": "The timestamp when the status message was last modified."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/status[/:status_id]"
       }
   }
   "message": "A status message of no more than 140 characters.",
   "user": "The user submitting the status message.",
   "timestamp": "The timestamp when the status message was last modified."
}',
            ),
            'DELETE' => array(
                'description' => 'Delete a status message.',
                'request' => null,
                'response' => null,
            ),
            'description' => 'Manipulate and retrieve individual status messages.',
        ),
        'description' => 'Create, manipulate, and retrieve status messages.',
    ),
);
