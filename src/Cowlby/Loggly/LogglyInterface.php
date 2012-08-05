<?php

namespace Cowlby\Loggly;

interface LogglyInterface
{
    public function getInput();

    public function send($message);
}
