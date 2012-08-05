<?php

namespace Cowlby\Loggly\Http;

interface ClientInterface
{
    const USER_AGENT = 'Loggly Monolog Handler/0.x (+https://github.com/cowlby/loggly-monolog-handler)';

    const HOST_LOGGLY = 'logs.loggly.com';
    const HOST_AWS = 'ec2.logs.loggly.com';

    const PORT_HTTP = 80;
    const PORT_HTTPS = 443;

    const CONTENT_TYPE_JSON = 'application/json';
    const CONTENT_TYPE_TEXT = 'text/plain';

    public function post($message);
}
