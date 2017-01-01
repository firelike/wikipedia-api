<?php
namespace Firelike\Wikipedia\Validator\Factory;


use Firelike\Wikipedia\Validator\ActionValidator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ActionValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new ActionValidator();
        return $validator;
    }

}