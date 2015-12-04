<?php

namespace Devhelp\Salesforce\Method\Authentication;

use Devhelp\Salesforce\Method\MethodTestCase;
use Prophecy\Argument;

/**
 * @author <michal@devhelp.pl>
 */
class UsernamePasswordOAuthAuthenticationTest extends MethodTestCase
{
    /**
     * @test
     */
    public function itShouldRunUsernamePasswordOAuthAuthenticationMethod()
    {
        $method = new UsernamePasswordOAuthAuthentication($this->getSalesforceClientMock('35.0'));
        $response = $method->call([
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
     * {@inheritdoc}
     */
    protected function getOptions()
    {
        return Argument::type('array');
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUri()
    {
        return '/services/oauth2/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getResponseStatusCode()
    {
        return 200;
    }

    /**
     * {@inheritdoc}
     */
    protected function getJsonResponsePath()
    {
        return __DIR__ . '/../Fixtures/UsernamePasswordOAuthAuthenticationTestResponse.json';
    }
}
