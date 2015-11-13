<?php

namespace Devhelp\Salesforce\Exception;

/**
 * @author <michal@devhelp.pl>
 */
abstract class SalesforceRestApiException extends \RuntimeException
{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
