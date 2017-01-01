<?php
namespace Firelike\Wikipedia;

use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;

class Module implements ConsoleUsageProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function getConsoleUsage(Console $console)
    {
        return array(
            // Describe available commands
            'wikipedia browser [--search=] [--verbose|-v]' => 'call browser service method',
            'wikipedia genres [--verbose|-v]' => 'call genres service method',
            'wikipedia persons [--search_person=] [--verbose|-v]' => 'call persons service method',

            // Describe expected parameters
            array(
                '--verbose|-v',
                '(optional) turn on verbose mode'
            ),
        );
    }
}