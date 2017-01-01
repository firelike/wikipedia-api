<?php
namespace Firelike\Wikipedia\Validator\Factory;


use Firelike\Wikipedia\Validator\ActionValidator;
use Firelike\Wikipedia\Validator\WikipediaServiceRequestValidator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class WikipediaServiceRequestValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new WikipediaServiceRequestValidator();
        $validator->setActionValidator($sm->get(ActionValidator::class));
        return $validator;
    }

}