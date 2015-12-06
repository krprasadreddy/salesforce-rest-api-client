<?php

namespace Devhelp\Salesforce\Exception;

use GuzzleHttp\Exception\ClientException;

/**
 * @author <michal@devhelp.pl>
 */
class ExceptionFactory
{
    /**
     * @param ClientException $baseException
     * @return SalesforceRestApiException
     */
    public function create(ClientException $baseException)
    {
        $message = '';
        $errorResponse = json_decode($baseException->getResponse()->getBody()->getContents(), true);

        if (isset($errorResponse['error'])) {
            $message = $errorResponse['error_description'];
        } elseif (isset($errorResponse[0])) {
            $message = $errorResponse[0]['message'];

        }

        return new SalesforceRestApiException($message, 400);
    }
}
