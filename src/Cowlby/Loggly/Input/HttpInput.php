<?php

namespace Cowlby\Loggly\Input;

class HttpInput implements HttpInputInterface
{
    protected $key;

    protected $format;

    public function __construct($key, $format = InputInterface::FORMAT_JSON)
    {
        $this->setKey($key);
        $this->setFormat($format);
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function setFormat($format)
    {
        if (!in_array($format, array(InputInterface::FORMAT_JSON, InputInterface::FORMAT_TEXT))) {
            throw new \InvalidArgumentException('Invalid input format.');
        }

        $this->format = $format;

        return $this;
    }
}
