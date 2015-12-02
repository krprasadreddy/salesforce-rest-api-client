<?php

namespace Devhelp\Salesforce\Client;

use Devhelp\Salesforce\Exception\ExceptionFactory;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * @author <michal@devhelp.pl>
 */
class SalesforceClient implements SalesforceClientInterface
{
    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var string
     */
    private $apiVersion;

    /**
     * @param ClientInterface $httpClient
     * @param string $apiVersion
     */
    public function __construct(ClientInterface $httpClient, $apiVersion)
    {
        $this->httpClient = $httpClient;
        $this->apiVersion = $apiVersion;
    }

    /**
     * {@inheritdoc}
     */
    public function call($method, $uri, array $options = [])
    {
        $exceptionFactory = new ExceptionFactory();

        try {
            return $this->httpClient->request($method, $uri, $options);
        } catch (ClientException $baseException) {
            throw $exceptionFactory->create($baseException);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }
}
