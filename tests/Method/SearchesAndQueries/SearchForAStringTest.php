<?php

namespace Devhelp\Salesforce\Method\SearchesAndQueries;

use Devhelp\Salesforce\Method\MethodTestCase;
use Prophecy\Argument;

/**
 * @author <michal@devhelp.pl>
 */
class SearchForAStringTest extends MethodTestCase
{
    /**
     * @test
     */
    public function itShouldCallSearchForAString()
    {
        $method = new SearchForAString($this->getSalesforceClientMock('35.0'));
        $response = $method->call('1234', [
            'q' => 'FIND {United}'
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf('Psr\Http\Message\ResponseInterface', $response);
        $this->assertArrayHasKey('attributes', $responseData[0]);
        $this->assertArrayHasKey('Id', $responseData[0]);
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
        return 'GET';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUri()
    {
        return '/services/data/v35.0/search/?q=FIND+%7BUnited%7D';
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
        return __DIR__. '/../Fixtures/SearchForAStringResponse.json';
    }
}
