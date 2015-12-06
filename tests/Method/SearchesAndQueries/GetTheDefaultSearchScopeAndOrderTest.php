<?php

namespace Devhelp\Salesforce\Method\SearchesAndQueries;

use Devhelp\Salesforce\Method\MethodTestCase;
use Prophecy\Argument;

/**
 * @author <michal@devhelp.pl>
 */
class GetTheDefaultSearchScopeAndOrderTest extends MethodTestCase
{
    /**
     * @test
     */
    public function itShouldCallGetTheDefaultSearchScopeAndOrder()
    {
        $method = new GetTheDefaultSearchScopeAndOrder($this->getSalesforceClientMock('35.0'));
        $response = $method->call('1234');

        $this->assertInstanceOf('Psr\Http\Message\ResponseInterface', $response);
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
        return '/services/data/v35.0/search/scopeOrder';
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
        return __DIR__. '/../Fixtures/GetTheDefaultSearchScopeAndOrderResponse.json';
    }
}
