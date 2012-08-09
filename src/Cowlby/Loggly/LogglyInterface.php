<?php

/*
 * This file is part of the PHP Loggly Bindings package.
 *
 * (c) Jose Prado <cowlby@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cowlby\Loggly;

use Cowlby\Loggly\Input\InputInterface;

/**
 * Defines the general interface of sending logs to Loggly.
 *
 * @author Jose Prado <cowlby@me.com>
 */
interface LogglyInterface
{
    /**
     * Sets the Input that the object should log to.
     *
     * @param InputInterface $input The Input to put into use.
     * @return LogglyInterface
     */
    public function setInput(InputInterface $input);

    /**
     * Returns the Input that the object is logging to.
     *
     * @return InputInterface The Input currently in use.
     */
    public function getInput();

    /**
     * Sends a message to Loggly for logging.
     *
     * @param string $message The message to log.
     * @return LogglyInterface
     */
    public function send($message);
}
