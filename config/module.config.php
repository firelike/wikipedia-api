<?php
return array(
    'controllers' => array(
        'factories' => [
            'Firelike\Wikipedia\Controller\Console' => Firelike\Wikipedia\Controller\Factory\ConsoleControllerFactory::class
        ]
    ),
    'service_manager' => array(
        'factories' => array(
            Firelike\Wikipedia\Service\WikipediaService::class => Firelike\Wikipedia\Service\Factory\WikipediaServiceFactory::class,
            Firelike\Wikipedia\Validator\WikipediaServiceRequestValidator::class => Firelike\Wikipedia\Validator\Factory\WikipediaServiceRequestValidatorFactory::class,
            Firelike\Wikipedia\Validator\ActionValidator::class => Firelike\Wikipedia\Validator\Factory\ActionValidatorFactory::class,
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'wikipedia-query' => array(
                    'options' => array(
                        'route' => 'wikipedia query [--titles=] [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\Wikipedia\Controller\Console',
                            'action' => 'query'
                        )
                    )
                ),
            )
        )
    ),
    'wikipedia_service' => [
        'description' => [
            'baseUri' => 'https://en.wikipedia.org',
            'apiVersion' => 'v1',
            'operations' => [
                'api_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/w/api.php',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'action' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query'
                        ],
                        'format' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query',
                            'description' => 'format',
                            'default'=>'json'
                        ],
                        'titles' => [
                            'type' => 'string',
                            'required' => false,
                            'location' => 'query',
                            'description' => 'A list of titles to work on.'
                        ],
                        'prop' => [
                            'type' => 'string',
                            'required' => false,
                            'location' => 'query',
                            'description' => 'Which properties to get for the queried pages.'
                        ],
                        'exintro' => [
                            'type' => 'boolean',
                            'required' => false,
                            'location' => 'query',
                            'description' => 'Return only content before the first section.'
                        ]
                    ]
                ],
            ],
            'models' => [
                'getResponse' => [
                    'type' => 'object',
                    "properties" => [
                        "success" => [
                            "type" => "string",
                            "required" => true
                        ],
                        "errors" => [
                            "type" => "array",
                            "items" => [
                                "type" => "object",
                                "properties" => [
                                    "code" => [
                                        "type" => "string",
                                        "description" => "The error code."
                                    ],
                                    "message" => [
                                        "type" => "string",
                                        "description" => "The detailed message from the server."
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'additionalProperties' => [
                        'location' => 'json'
                    ]
                ]
            ]
        ]
    ]
);


