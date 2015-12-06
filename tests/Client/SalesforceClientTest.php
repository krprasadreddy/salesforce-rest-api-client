<?php

namespace Devhelp\Salesforce\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * @author <michal@devhelp.pl>
 */
class SalesforceClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldCallMethodToSalesforceRestApi()
    {
        $response = new Response(200, []);
        $salesforceClient = new SalesforceClient($this->getHttpClientMock($response), '35.0');
        $response = $salesforceClient->call('POST', '/', []);

        $this->assertEquals($response->getStatusCode(), 200);
    }

    /**
     * @test
     * @expectedException \Devhelp\Salesforce\Exception\SalesforceRestApiException
     */
    public function itShouldThrowSalesforceExceptionWhenResponseHasManyMessagesAndErrorCodes()
    {
        $responseMock = $this->getHttpClientExceptionMock('[{"message":"test","errorCode":"test"}]');
        $salesforceClient = new SalesforceClient($this->getHttpClientMock($responseMock), '35.0');
        $response = $salesforceClient->call('POST', '/1', []);

        $this->assertEquals($response->getStatusCode(), 400);
    }

    /**
     * @test
     * @expectedException \Devhelp\Salesforce\Exception\SalesforceRestApiException
     */
    public function itShouldThrowSalesforceExceptionWhenResponseHasMessageAndErrorCode()
    {
        $responseMock = $this->getHttpClientExceptionMock('{"error_description":"test","error":"test"}');
        $salesforceClient = new SalesforceClient($this->getHttpClientMock($responseMock), '35.0');
        $response = $salesforceClient->call('POST', '/1', []);

        $this->assertEquals($response->getStatusCode(), 400);
    }

    /**
     * @test
     */
    public function itShouldRetrieveApiVersion()
    {
        $response = new Response(200, []);
        $salesforceClient = new SalesforceClient($this->getHttpClientMock($response), '35.0');

        $this->assertEquals($salesforceClient->getApiVersion(), '35.0');
    }

    private function getHttpClientMock($response)
    {
        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);;

        return $client;
    }

    private function getHttpClientExceptionMock($content)
    {
        return new ClientException(
            'test',
            new Request('POST', '/'),
            new Response(200, [], $content)
        );
    }
}
