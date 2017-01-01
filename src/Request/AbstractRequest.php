<?php
namespace Firelike\Wikipedia\Request;


abstract class AbstractRequest
{
    /**
     * @var string
     */
    protected $action;
    /**
     * @var string
     */
    protected $format;

    const SORT_ORDER_ASC = 'ASC';
    const SORT_ORDER_DESC = 'DESC';
    const FORMAT_JSON = 'json';

    public function toArray()
    {
        return [
            'action' => $this->getAction(),
            'format' => $this->getFormat()
        ];
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return AbstractRequest
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }


    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return AbstractRequest
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }


}