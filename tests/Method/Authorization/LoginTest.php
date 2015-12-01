<?php

namespace Devhelp\Salesforce\Method\Authorization;

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
        $response = $method->call([
            'grant_type' => 'password',
            'client_id' => '12345',
            'client_secret' => '12345',
            'username' => 'user@example.com',
            'password' => 'test1234'
        ]);
        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf('Psr\Http\Message\ResponseInterface', $response);
        $this->assertArrayHasKey('access_token', $responseData);
        $this->assertArrayHasKey('instance_url', $responseData);
        $this->assertArrayHasKey('id', $responseData);
        $this->assertArrayHasKey('token_type', $responseData);
        $this->assertArrayHasKey('issued_at', $responseData);
        $this->assertArrayHasKey('signature', $responseData);
    }

    /**
     * @return SalesforceClientInterface
     */
    private function getSalesforceClientMock()
    {
        $salesforceClient = $this->prophesize('Devhelp\Salesforce\Client\SalesforceClientInterface');
        $salesforceClient
            ->call('POST', '/services/oauth2/token', Argument::type('array'))
            ->willReturn(new Response(200, [],
                '{"access_token":"1234","instance_url":"https:\/\/eu5.salesforce.com","id":"1","token_type":"Bearer",
                "issued_at":"1446587266836","signature":"1234"}'));

        return $salesforceClient->reveal();
    }
}
