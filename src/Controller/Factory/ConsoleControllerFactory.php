<?php
namespace Firelike\Wikipedia\Controller\Factory;


use Firelike\Wikipedia\Controller\ConsoleController;
use Firelike\Wikipedia\Service\WikipediaService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;


class ConsoleControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {

        $service = $sm->get(WikipediaService::class);

        $controller = new ConsoleController();
        $controller->setService($service);

        return $controller;

    }

}