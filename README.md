PHP Loggly Bindings
===================

[![Build Status](https://secure.travis-ci.org/cowlby/php-loggly-bindings.png?branch=master)](http://travis-ci.org/cowlby/php-loggly-bindings)

This PHP Loggly bindings library provides a simple PHP interface with which to send logs to Loggly.


Getting started
---------------

### Installing via Composer

The recommended way to install the library is through [Composer](http://getcomposer.org).

1. Add ``cowlby/php-loggly-bindings`` as a dependency in your project's ``composer.json`` file:

        {
            "require": {
                "cowlby/php-loggly-bindings": "*"
            }
        }

    Consider tightening your dependencies to a known version when deploying mission critical applications (e.g. ``0.*``).

2. Download and install Composer:

        curl -s http://getcomposer.org/installer | php

3. Install your dependencies:

        php composer.phar install

4. Require Composer's autoloader

    Composer also prepares an autoload file that's capable of autoloading all of the classes in any of the libraries that it downloads. To use it, just add the following line to your code's bootstrap process:

        require 'vendor/autoload.php';

You can find out more on how to install Composer, configure autoloading, and other best-practices for defining dependencies at [getcomposer.org](http://getcomposer.org).


Usage
-----

The library is configured with a simple asyncrhonous HTTP client with which to send messages to Loggly. Usage is as simple as doing the following.

```php
<?php

// Input key specified by Loggly.
$key = '83e527d7-fad3-4d93-89da-0c2d8c0bcd6c';

// Create the logger.
$loggly = new ApiLogger($key);

// Log a message to the HTTP input specified by the key.
$loggly->send('Hello World!');
```

For simple messages, the default internal client used is good enough. If you
need to send many messsages, like when using the Monolog wrapper, then
switching to the buffered client is a better choice. This can be done as
follows:

```php
<?php

// Input key specified by Loggly.
$key = '83e527d7-fad3-4d93-89da-0c2d8c0bcd6c';

// Create and configure the logger.
$loggly = new ApiLogger($key);
$loggly['client.class'] = 'Cowlby\\Loggly\\Http\\BufferedAsyncClient';

// Log a message to the HTTP input specified by the key.
$loggly
    ->send('Hello World 1!')
    ->send('Hello World 2!')
;
```

The two messages will be POSTed to the API using a single asyncrhonous
connection.


Extending the library
---------------------

Included are an HTTP Input entity class and a basic asynchronous HTTP client
class. These are based on various simple interfaces which allow you to easily
extend the library and implement other parts of the Loggly API.
