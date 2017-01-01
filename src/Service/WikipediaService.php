<?php
namespace Firelike\Wikipedia\Service;

use Firelike\Wikipedia\Request\AbstractRequest;
use Firelike\Wikipedia\Request\QueryAction as QueryActionRequest;

use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\ResultInterface;

/**
 * Class WikipediaService
 * @package Firelike\Wikipedia\Service
 *
 * @method ResultInterface api_command(array $args)
 *
 */
class WikipediaService extends GuzzleClient
{
    /**
     * @var \Firelike\Wikipedia\Validator\WikipediaServiceRequestValidator
     */
    protected $requestValidator;

    /**
     * @param QueryActionRequest $request
     * @return array|mixed
     */
    public function query(QueryActionRequest $request)
    {
        $request->setFormat(AbstractRequest::FORMAT_JSON)->setAction('query');

        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }

        return $this->api_command(array_filter($request->toArray()));
    }


    /**
     * @return \Firelike\Wikipedia\Validator\WikipediaServiceRequestValidator
     */
    public function getRequestValidator()
    {
        return $this->requestValidator;
    }

    /**
     * @param \Firelike\Wikipedia\Validator\WikipediaServiceRequestValidator $requestValidator
     */
    public function setRequestValidator($requestValidator)
    {
        $this->requestValidator = $requestValidator;
    }

}