<?php

namespace Devhelp\Salesforce\Method;

use Devhelp\Salesforce\Client\SalesforceClientInterface;
use GuzzleHttp\Psr7\Response;

/**
 * @author <michal@devhelp.pl>
 */
abstract class MethodTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $apiVersion
     * @return SalesforceClientInterface
     */
    protected function getSalesforceClientMock($apiVersion)
    {
        $response = new Response($this->getResponseStatusCode(), [], file_get_contents($this->getJsonResponsePath()));
        $salesforceClient = $this->prophesize('Devhelp\Salesforce\Client\SalesforceClientInterface');
        $salesforceClient->getApiVersion()->willReturn($apiVersion);
        $salesforceClient
            ->call($this->getMethod(), $this->getUri(), $this->getOptions())
            ->willReturn($response);

        return $salesforceClient->reveal();
    }

    /**
     * @array
     */
    abstract protected function getOptions();

    /**
     * @return string
     */
    abstract protected function getMethod();

    /**
     * @return string
     */
    abstract protected function getUri();

    /**
     * @return string
     */
    abstract protected function getResponseStatusCode();

    /**
     * @return string
     */
    abstract protected function getJsonResponsePath();
}
