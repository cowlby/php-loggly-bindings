<?php

namespace Cowlby\Loggly\Http;

use Cowlby\Loggly\Input\InputInterface;
use Cowlby\Loggly\Input\HttpInputInterface;

abstract class AbstractClient implements ClientInterface
{
    protected $input;

    protected $host;

    protected $port;

    public function __construct(HttpInputInterface $input, $host = ClientInterface::HOST_LOGGLY, $port = ClientInterface::PORT_HTTPS)
    {
        $this->setInput($input);
        $this->setHost($host);
        $this->setPort($port);
    }

    public function getInput()
    {
        return $this->input;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setInput(HttpInputInterface $input)
    {
        $this->input = $input;
        return $this;
    }

    public function setHost($host)
    {
        if (!in_array($host, array(ClientInterface::HOST_AWS, ClientInterface::HOST_LOGGLY))) {
            throw new \InvalidArgumentException('Invalid host choice.');
        }

        $this->host = $host;
        return $this;
    }

    public function setPort($port)
    {
        if (!in_array($port, array(ClientInterface::PORT_HTTP, ClientInterface::PORT_HTTPS))) {
            throw new \InvalidArgumentException('Invalid port choice.');
        }

        $this->port = $port;
        return $this;
    }

    public function getContentType()
    {
        switch ($this->input->getFormat()) {

            case InputInterface::FORMAT_JSON:
                return ClientInterface::CONTENT_TYPE_JSON;
                break;

            case InputInterface::FORMAT_TEXT:
                return ClientInterface::CONTENT_TYPE_TEXT;
                break;

            default:
                throw new \LogicException('Allowed invalid input format to be set.');
        }
    }
}
