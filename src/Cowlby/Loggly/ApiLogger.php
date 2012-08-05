<?php

namespace Cowlby\Loggly;

use Pimple;
use Cowlby\Loggly\Input\InputInterface;
use Cowlby\Loggly\Http\ClientInterface;

class ApiLogger extends Pimple implements LogglyInterface
{
    public function __construct($key)
    {
        $this['input.key'] = $key;

        $this['input.format'] = InputInterface::FORMAT_JSON;

        $this['input.class'] = 'Cowlby\\Loggly\\Input\\HttpInput';

        $this['input'] = $this->share(function($container) {

            return new $container['input.class'](
                $container['input.key'],
                $container['input.format']
            );
        });

        $this['client.host'] = ClientInterface::HOST_LOGGLY;

        $this['client.port'] = ClientInterface::PORT_HTTPS;

        $this['client.class'] = 'Cowlby\\Loggly\\Http\\AsyncClient';

        $this['client'] = $this->share(function($container) {

            return new $container['client.class'](
                $container['input'],
                $container['client.host'],
                $container['client.port']
            );
        });
    }

    public function getInput()
    {
        return $this['input'];
    }

    public function send($message)
    {
        $this['client']->post($message);
    }
}
