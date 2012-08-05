<?php

namespace Cowlby\Loggly\Http;

class AsyncClient extends AbstractClient
{
    public function post($message)
    {
        $fp = fsockopen($this->getTransport(), $this->getPort(), $errno, $errstr, 30);

        if (FALSE === $fp) {
            throw new \RuntimeException($errstr, $errno);
        }

        $request = "POST /inputs/" . $this->input->getKey() . " HTTP/1.1\r\n";
        $request.= "Host: " . $this->getHost() . "\r\n";
        $request.= "User-Agent: " . ClientInterface::USER_AGENT . "\r\n";
        $request.= "Content-Type: " . $this->getContentType() . "\r\n";
        $request.= "Content-Length: " . strlen($message) . "\r\n";
        $request.= "Connection: Close\r\n\r\n";
        $request.= $message;

        fwrite($fp, $request);
        fclose($fp);

        return TRUE;
    }

    public function getTransport()
    {
        $host = $this->getHost();

        if ($this->getPort() === ClientInterface::PORT_HTTPS) {
            $host = 'ssl://' . $host;
        }

        return $host;
    }
}
