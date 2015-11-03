<?php

namespace Devhelp\Salesforce\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * @author <michal@devhelp.pl>
 */
class SalesforceClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SalesforceClient
     */
    private $salesforceClient;

    public function setUp()
    {
        $this->salesforceClient = new SalesforceClient($this->getHttpClientMock(), '35.0');
    }

    /**
     * @test
     */
    public function itShouldCallMethodToSalesforceRestApi()
    {
        $response = $this->salesforceClient->call('POST', '/', []);

        $this->assertEquals($response->getStatusCode(), 200);
    }

    /**
     * @test
     */
    public function itShouldRetrieveApiVersion()
    {
        $this->assertEquals($this->salesforceClient->getApiVersion(), '35.0');
    }

    private function getHttpClientMock()
    {
        $mock = new MockHandler([
            new Response(200, [])
        ]);
        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler]);
    }
}
