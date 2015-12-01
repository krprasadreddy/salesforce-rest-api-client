<?php

namespace Devhelp\Salesforce\Method\Records;

use Devhelp\Salesforce\Client\SalesforceClientInterface;
use GuzzleHttp\Psr7\Response;
use Prophecy\Argument;

/**
 * @author <michal@devhelp.pl>
 */
class CreateRecordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldCallCreateObject()
    {
        $method = new CreateARecord($this->getSalesforceClientMock());
        $response = $method->call('Account', '1234', [
            'Name' => 'AccountName'
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf('Psr\Http\Message\ResponseInterface', $response);
        $this->assertArrayHasKey('id', $responseData);
        $this->assertArrayHasKey('success', $responseData);
        $this->assertArrayHasKey('errors', $responseData);
    }

    /**
     * @return SalesforceClientInterface
     */
    private function getSalesforceClientMock()
    {
        $salesforceClient = $this->prophesize('Devhelp\Salesforce\Client\SalesforceClientInterface');
        $salesforceClient->getApiVersion()->willReturn('35.0');
        $salesforceClient
            ->call('POST', '/services/data/v35.0/sobjects/Account/', Argument::type('array'))
            ->willReturn(new Response(200, [],
                '{"id":"0012400000ORoH9AA","success":true,"errors":[]}'));

        return $salesforceClient->reveal();
    }
}
