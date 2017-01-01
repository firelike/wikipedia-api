<?php
namespace Firelike\Wikipedia\Controller;

use Firelike\Wikipedia\Request\QueryAction as QueryActionRequest;
use Zend\Mvc\Console\Controller\AbstractConsoleController;


class ConsoleController extends AbstractConsoleController
{
    /**
     * @var \Firelike\Wikipedia\Service\WikipediaService
     */
    protected $service;

    public function queryAction()
    {
        $this->markBegin();

        $request = new QueryActionRequest();

        $titles = $this->getRequest()->getParam('titles');
        if ($titles) {
            $request->setTitles($titles);
        } else {
            $request->setTitles('IBM');
        }

        $request->setProp('extracts');

        $result = $this->getService()->query($request);

        $records = $result->toArray();

        var_dump($records);

        $this->markEnd();
    }


    public function markBegin()
    {
        $delimiter = str_repeat('=', 10);
        $this->getConsole()->writeLine(implode('BEGIN', [
            $delimiter,
            $delimiter
        ]));
    }

    public function markEnd()
    {
        $request = $this->getRequest();
        $verbose = $request->getParam('verbose') || $request->getParam('v');

        if ($verbose) {
            $this->getConsole()->writeLine("Done");
        }

        $delimiter = str_repeat('=', 10);
        $this->getConsole()->writeLine(implode('END', [
            $delimiter,
            $delimiter
        ]));
    }

    /**
     * @return \Firelike\Wikipedia\Service\WikipediaService
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param \Firelike\Wikipedia\Service\WikipediaService $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }


}

