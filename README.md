## Wikipedia API Client

[![Build Status](https://travis-ci.org/firelike/wikipedia-api.svg?branch=master&format=flat-square)](https://travis-ci.org/firelike/wikipedia-api)
[![License](https://poser.pugx.org/firelike/wikipedia-api/license?format=flat-square)](https://packagist.org/packages/firelike/wikipedia-api)


## Introduction

Zend Framework module to consume Wikipedia API

## Installation
Install the module using Composer into your application's vendor directory. Add the following line to your
`composer.json`.

```json
{
    "require": {
        "firelike/wikipedia-api": "^1.0"
    }
}
```
## Configuration

Enable the module in your `application.config.php` file.

```php
return array(
    'modules' => array(
        'Firelike\Wikipedia'
    )
);
```

Copy and paste the `wikipedia.local.php.dist` file to your `config/autoload` folder and customize it with your credentials and
other configuration settings. Make sure to remove `.dist` from your file.Your `wikipedia.local.php` might look something like the following:

```php
<?php
return [
    'wikipedia_service' => [
        'log'=>[
            'enable'=>false,
            'message_formats'=>[
                '{method} {uri} HTTP/{version} {req_body}',
                'RESPONSE: {code} - {res_body}',
            ],
            'logger'=>[
                 'stream' => 'php://output',
            ]
        ]
    ]
];
```

## Usage

Calling from your code:

```php
        use Firelike\Wikipedia\Request\QueryAction as QueryActionRequest;
        use Firelike\Wikipedia\Service\WikipediaService;

        
        $request = new QueryActionRequest();
        $request->setTitles('HarperCollins')
            ->setProp('extracts');

        $service = new WikipediaService();
        $result = $service->query($request);
        
        $pages= $result->toArray()['query']['pages'];
        var_dump($pages);
        
```

Using the console:

```php
php public/index.php wikipedia query --titles=HarperCollins -v
```
## Implemented Service Methods:

* **query**


## Links

* [Zend Framework](http://framework.zend.com)
* [Wikipedia API](https://www.mediawiki.org/wiki/API:Main_page)
* [Wikipedia API Sandbox](https://en.wikipedia.org/wiki/Special:ApiSandbox)
