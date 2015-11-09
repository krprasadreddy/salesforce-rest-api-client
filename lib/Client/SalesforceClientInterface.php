<?php

namespace Devhelp\Salesforce\Client;

use Psr\Http\Message\ResponseInterface;

/**
 * @author <michal@devhelp.pl>
 */
interface SalesforceClientInterface
{
    /**
     * It resolves http request to salesforce rest api
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function call($method, $uri, array $options = []);

    /**
     * This field is required to resolve which API version we call
     *
     * @return string
     */
    public function getApiVersion();
}
