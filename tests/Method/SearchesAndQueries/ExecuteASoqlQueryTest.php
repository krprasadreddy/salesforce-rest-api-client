<?php

namespace Devhelp\Salesforce\Method\SearchesAndQueries;

use Devhelp\Salesforce\Client\SalesforceClientInterface;
use GuzzleHttp\Psr7\Response;
use Prophecy\Argument;

/**
 * @author <michal@devhelp.pl>
 */
class ExecuteASoqlQueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldCallExecuteASoqlQuery()
    {
        $method = new ExecuteASoqlQuery($this->getSalesforceClientMock());
        $response = $method->call('1234', [
            'q' => 'SELECT+name+from+Account'
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf('Psr\Http\Message\ResponseInterface', $response);
        $this->assertArrayHasKey('done', $responseData);
        $this->assertArrayHasKey('totalSize', $responseData);
        $this->assertArrayHasKey('records', $responseData);
    }

    /**
     * @return SalesforceClientInterface
     */
    private function getSalesforceClientMock()
    {
        $salesforceClient = $this->prophesize('Devhelp\Salesforce\Client\SalesforceClientInterface');
        $salesforceClient->getApiVersion()->willReturn('35.0');
        $salesforceClient
            ->call('GET', '/services/data/v35.0/query/?q=SELECT+name+from+Account', Argument::type('array'))
            ->willReturn(new Response(200, [],
                '{"done":true,"totalSize":2,"records":[{"attributes":{"type":"Account","url":
                "/services/data/v20.0/sobjects/Account/001D000000IRFmaIAH"},"Name":"Test 1"},{"attributes":{"type":
                "Account","url":"/services/data/v20.0/sobjects/Account/001D000000IomazIAB"},"Name":"Test 2"}]}'));

        return $salesforceClient->reveal();
    }
}
