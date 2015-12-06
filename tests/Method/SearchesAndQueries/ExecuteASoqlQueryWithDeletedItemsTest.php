<?php

namespace Devhelp\Salesforce\Method\SearchesAndQueries;

use Devhelp\Salesforce\Method\MethodTestCase;
use Prophecy\Argument;

/**
 * @author <michal@devhelp.pl>
 */
class ExecuteASoqlQueryWithDeletedItemsTest extends MethodTestCase
{
    /**
     * @test
     */
    public function itShouldCallExecuteASoqlQuery()
    {
        $method = new ExecuteASoqlQueryWithDeletedItems($this->getSalesforceClientMock('35.0'));
        $response = $method->call('1234', [
            'q' => 'SELECT+name+from+Account+WHERE+isDeleted+=+TRUE'
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
        return '/services/data/v35.0/queryAll/?q=SELECT+name+from+Account+WHERE+isDeleted+=+TRUE';
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
        return __DIR__. '/../Fixtures/ExecuteASoqlQueryWithDeletedItemsResponse.json';
    }
}
