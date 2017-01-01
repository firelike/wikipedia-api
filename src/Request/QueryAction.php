<?php
namespace Firelike\Wikipedia\Request;


class QueryAction extends AbstractRequest
{

    /**
     * @var string
     */
    protected $titles;
    /**
     * @var string
     */
    protected $prop;

    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'titles' => $this->getTitles(),
            'prop' => $this->getProp(),
        ));
    }

    /**
     * @return string
     */
    public function getTitles()
    {
        return $this->titles;
    }

    /**
     * @param string $titles
     * @return QueryAction
     */
    public function setTitles($titles)
    {
        $this->titles = $titles;
        return $this;
    }

    /**
     * @return string
     */
    public function getProp()
    {
        return $this->prop;
    }

    /**
     * @param string $prop
     * @return QueryAction
     */
    public function setProp($prop)
    {
        $this->prop = $prop;
        return $this;
    }


}