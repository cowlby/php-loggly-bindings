<?php

/*
 * This file is part of the PHP Loggly Bindings package.
 *
 * (c) Jose Prado <cowlby@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cowlby\Loggly\Http;

/**
 * POSTs messages to Loggly asynchronously.
 *
 * It works by using the `Connection: Close` header which sends the request
 * and doesn't wait for a response.
 *
 * @author Jose Prado <cowlby@me.com>
 */
class AsyncClient extends AbstractClient
{
    protected $hostname;

    /**
     * {@inheritdoc}
     */
    public function post($message)
    {
        $fp = fsockopen($this->getTransport(), ClientInterface::LOGGLY_PORT, $errno, $errstr, 30);

        if (FALSE === $fp) {
            throw new \RuntimeException($errstr, $errno);
        }

        $request = "POST /inputs/" . $this->input->getKey() . " HTTP/1.1\r\n";
        $request .= "Host: " . ClientInterface::LOGGLY_HOST . "\r\n";
        $request .= "User-Agent: " . ClientInterface::USER_AGENT . "\r\n";
        $request .= "Content-Type: " . $this->getContentType() . "\r\n";
        $request .= "Content-Length: " . strlen($message) . "\r\n";
        $request .= "Connection: Close\r\n\r\n";
        $request .= $message;

        fwrite($fp, $request);
        fclose($fp);

        return TRUE;
    }

    /**
     * Gets the transport string to use in fsockopen.
     *
     * @return string
     */
    public function getTransport()
    {
        return 'ssl://' . ClientInterface::LOGGLY_HOST;
    }
}
