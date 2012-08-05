<?php

namespace Cowlby\Loggly\Input;

interface InputInterface
{
    const FORMAT_JSON = 'json';
    const FORMAT_TEXT = 'text';

    public function getFormat();
}
