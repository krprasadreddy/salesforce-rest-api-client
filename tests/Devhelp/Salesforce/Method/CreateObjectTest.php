<?php

namespace Devhelp\Salesforce;

use Devhelp\Salesforce\Client\SalesforceClientInterface;
use Devhelp\Salesforce\Method\CreateObject;
use GuzzleHttp\Psr7\Response;
use Prophecy\Argument;

/**
 * @author <michal@devhelp.pl>
 */
class CreateObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldRunCreateObject()
    {
        $method = new CreateObject($this->getSalesforceClientMock());
        $response = $method->run('1234', 'Account', [
            'Name' => 'AccountName'
        ]);

        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('success', $response);
        $this->assertArrayHasKey('errors', $response);
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
