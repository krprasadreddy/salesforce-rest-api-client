<?php

namespace Devhelp\Salesforce\Client;

use Devhelp\Salesforce\Exception\SalesforceRestApiException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\ClientInterface;

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
     * @return ResponseInterface|SalesforceRestApiException
     */
    public function call($method, $uri, array $options = []);

    /**
     * This field is required to resolve which API version we call
     *
     * @return string
     */
    public function getApiVersion();

    /**
     * We need this method to replace url for salesforce instance
     *
     * @param ClientInterface $httpClient
     */
    public function replaceHttpClient(ClientInterface $httpClient);
}
