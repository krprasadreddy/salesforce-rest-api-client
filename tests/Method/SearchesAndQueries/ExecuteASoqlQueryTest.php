<?php

namespace Devhelp\Salesforce\Method\SearchesAndQueries;

use Devhelp\Salesforce\Method\MethodTestCase;
use Prophecy\Argument;

/**
 * @author <michal@devhelp.pl>
 */
class ExecuteASoqlQueryTest extends MethodTestCase
{
    /**
     * @test
     */
    public function itShouldCallExecuteASoqlQuery()
    {
        $method = new ExecuteASoqlQuery($this->getSalesforceClientMock('35.0'));
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
        return '/services/data/v35.0/query/?q=SELECT+name+from+Account';
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
        return __DIR__. '/../Fixtures/ExecuteASoqlQueryResponse.json';
    }
}
