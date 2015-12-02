<?php

namespace Devhelp\Salesforce\Client;

use GuzzleHttp\Client;

/**
 * @author <michal@devhelp.pl>
 */
class SalesforceClientFactory
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var string
     */
    private $apiVersion;

    /**
     * @param string $baseUrl
     * @param string $apiVersion
     */
    public function __construct($baseUrl = 'https://ap1.salesforce.com', $apiVersion = '35.0')
    {
        $this->baseUrl = $baseUrl;
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return SalesforceClient
     */
    public function getClient()
    {
        $client = new Client([
            'base_uri' => $this->baseUrl
        ]);

        return new SalesforceClient($client, $this->apiVersion);
    }
}
