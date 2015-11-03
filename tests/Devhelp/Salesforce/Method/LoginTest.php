<?php

namespace Devhelp\Salesforce\Method;

use Devhelp\Salesforce\Client\SalesforceClientInterface;
use GuzzleHttp\Psr7\Response;
use Prophecy\Argument;

/**
 * @author <michal@devhelp.pl>
 */
class LoginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldRunLoginMethod()
    {
        $method = new Login($this->getSalesforceClientMock());
        $response = $method->run([
            'grant_type' => 'password',
            'client_id' => '12345',
            'client_secret' => '12345',
            'username' => 'user@example.com',
            'password' => 'test1234'
        ]);

        $this->assertArrayHasKey('access_token', $response);
        $this->assertArrayHasKey('instance_url', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('token_type', $response);
        $this->assertArrayHasKey('issued_at', $response);
        $this->assertArrayHasKey('signature', $response);
    }

    /**
     * @return SalesforceClientInterface
     */
    private function getSalesforceClientMock()
    {
        $salesforceClient = $this->prophesize('Devhelp\Salesforce\Client\SalesforceClientInterface');
        $salesforceClient
            ->call(Login::METHOD, Login::URI, Argument::type('array'))
            ->willReturn(new Response(200, [],
                '{"access_token":"1234","instance_url":"https:\/\/eu5.salesforce.com","id":"1","token_type":"Bearer",
                "issued_at":"1446587266836","signature":"1234"}'));

        return $salesforceClient->reveal();
    }
}
