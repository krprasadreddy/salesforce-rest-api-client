<?php

namespace Devhelp\Salesforce\Method\SearchesAndQueries;

use Devhelp\Salesforce\Method\MethodTestCase;
use Prophecy\Argument;

/**
 * @author <michal@devhelp.pl>
 */
class GetFeedbackOnQueryPerformanceTest extends MethodTestCase
{
    /**
     * @test
     */
    public function itShouldCallGetFeedbackOnQueryPerformance()
    {
        $method = new GetFeedbackOnQueryPerformance($this->getSalesforceClientMock('35.0'));
        $response = $method->call('1234', [
            'explain' => 'SELECT+name+from+Account'
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->assertInstanceOf('Psr\Http\Message\ResponseInterface', $response);
        $this->assertArrayHasKey('plans', $responseData);
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
        return '/services/data/v35.0/query/?explain=SELECT+name+from+Account';
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
        return __DIR__. '/../Fixtures/GetFeedbackOnQueryPerformanceResponse.json';
    }
}
