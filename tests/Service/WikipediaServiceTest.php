<?php
namespace Firelike\Wikipedia\Test\Service;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../src/Service/Factory/WikipediaServiceFactory.php';
require_once __DIR__ . '/../../src/Service/WikipediaService.php';

require_once __DIR__ . '/../../src/Request/AbstractRequest.php';
require_once __DIR__ . '/../../src/Request/QueryAction.php';

require_once __DIR__ . '/../../src/Validator/WikipediaServiceRequestValidator.php';
require_once __DIR__ . '/../../src/Validator/ActionValidator.php';

use Firelike\Wikipedia\Request\QueryAction as QueryActionRequest;

use Firelike\Wikipedia\Service\Factory\WikipediaServiceFactory;
use Firelike\Wikipedia\Service\WikipediaService;

use Firelike\Wikipedia\Validator\ActionValidator;
use Firelike\Wikipedia\Validator\WikipediaServiceRequestValidator;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\ResultInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class WikipediaServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Firelike\Wikipedia\Service\WikipediaService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();


        //$client= $this->createClientWithMockHandler();
        $client = $this->createClientWithHandler();


        $config = include __DIR__ . '/../../config/module.config.php';
        $description = new Description($config['wikipedia_service']['description']);

        $this->service = new WikipediaService($client, $description);

        $validator = new WikipediaServiceRequestValidator();
        $validator->setActionValidator(new ActionValidator());

        $this->service->setRequestValidator($validator);

    }

    protected function createClientWithHandler()
    {

        $config = [
            'wikipedia_service' => [
                'log' => [
                    'enable' => false,
                    'message_formats' => [
                        '{method} {uri} HTTP/{version} {req_body}',
                        'RESPONSE: {code} - {res_body}',
                    ],
                    'logger' => [
                        'stream' => 'php://output',
                    ]
                ]
            ]
        ];
        $factory = new WikipediaServiceFactory();
        $handlerStack = $factory->createHandlerStack($config['wikipedia_service']['log']);


        $client = new Client([
            'handler' => $handlerStack
        ]);

        return $client;
    }


    protected function createClientWithMockHandler()
    {

        $mock = new MockHandler();
        $responses = [
            new Response(200, [], '{}'),
        ];

        foreach ($responses as $response) {
            $mock->append($response);
        }

        $client = new Client([
            'handler' => $mock
        ]);
        return $client;
    }


    public function testQuery()
    {
        $request = new QueryActionRequest();
        $request->setTitles('HarperCollins')
            ->setProp('extracts');

        $result = $this->service->query($request);

        $this->assertInstanceOf(ResultInterface::class, $result);
        $this->assertArrayHasKey('query', $result->toArray());
        $this->assertArrayHasKey('pages', $result->toArray()['query']);

    }


    public function testActionValidatorWorksWithValidValues()
    {
        $validator = new ActionValidator();
        $result = $validator->isValid('query');
        $this->assertEquals(true, $result);
    }

    public function testActionValidatorWorksWithInvalidValues()
    {
        $validator = new ActionValidator();
        $result = $validator->isValid('false_action');
        $this->assertEquals(false, $result);
    }


}

