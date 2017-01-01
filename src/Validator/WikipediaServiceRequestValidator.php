<?php
namespace Firelike\Wikipedia\Validator;


use Firelike\Wikipedia\Request\AbstractRequest;
use Zend\Validator\AbstractValidator;

class WikipediaServiceRequestValidator extends AbstractValidator
{
    /**
     * @var ActionValidator
     */
    protected $actionValidator;

    /**
     * @param mixed $request
     * @return bool
     */
    public function isValid($request)
    {
        if (!$request instanceof AbstractRequest) {
            return false;
        }

        if (method_exists($request, 'getAction')) {
            if ($request->getAction()) {
                $validator = $this->getActionValidator();
                if (!$validator->isValid($request->getAction())) {
                    $this->setMessage('Invalid Action');
                    return false;
                }
            }
        }


        return true;
    }

    /**
     * @return ActionValidator
     */
    public function getActionValidator()
    {
        return $this->actionValidator;
    }

    /**
     * @param ActionValidator $actionValidator
     */
    public function setActionValidator($actionValidator)
    {
        $this->actionValidator = $actionValidator;
    }


}