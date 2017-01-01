<?php
namespace Firelike\Wikipedia\Service\Factory;


use Firelike\Wikipedia\Service\WikipediaService;
use Firelike\Wikipedia\Validator\WikipediaServiceRequestValidator;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Zend\Log\Logger;
use Zend\Log\PsrLoggerAdapter;
use Zend\Log\Writer\Stream as StreamWriter;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use GuzzleHttp\Client;


class WikipediaServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {

        $config = $sm->get('Config');

        if (!isset($config['wikipedia_service'])) {
            throw  new \Exception('Required configuration node - wikipedia_service is missing');
        }

        if (!isset($config['wikipedia_service']['description'])) {
            throw  new \Exception('Required wikipedia_service configuration parameters are missing is missing');
        }

        $handlerStack = $this->createHandlerStack($config);
        $client = new Client([
            'handler' => $handlerStack
        ]);


        $description = new Description($config['wikipedia_service']['description']);

        $service = new WikipediaService($client, $description);

        $service->setRequestValidator($sm->get(WikipediaServiceRequestValidator::class));

        return $service;

    }


    public function createHandlerStack(array $config)
    {
        $handlerStack = HandlerStack::create();

        // append log middleware if enabled
        if (isset($config['wikipedia_service']['log'])) {

            $logConfig = $config['wikipedia_service']['log'];

            if (isset($logConfig['enable'])) {

                if ($logConfig['enable'] == true) {

                    $logger = new Logger();

                    $stream = 'php://output';
                    if (isset($logConfig['logger'])) {
                        if (isset($logConfig['logger']['stream'])) {
                            $stream = $logConfig['logger']['stream'];
                        }
                    }
                    $writer = new StreamWriter($stream);
                    $logger->addWriter($writer);

                    $psrLogger = new PsrLoggerAdapter($logger);

                    $messageFormats = [];
                    if (isset($logConfig['message_formats'])) {
                        $messageFormats = $logConfig['message_formats'];
                    }
                    foreach ($messageFormats as $messageFormat) {
                        $handlerStack->unshift(
                            Middleware::log($psrLogger, new MessageFormatter($messageFormat))
                        );
                    }

                }
            }
        }

        return $handlerStack;
    }

}