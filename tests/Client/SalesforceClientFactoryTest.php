<?php

namespace Devhelp\Salesforce\Client;

/**
 * @author <michal@devhelp.pl>
 */
class SalesforceClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldRetrieveInstanceOfSalesforceRestApiClient()
    {
        $factory = new SalesforceClientFactory();
        $salesforceClient = $factory->getClient();
        $this->assertInstanceOf('Devhelp\Salesforce\Client\SalesforceClient', $salesforceClient);
        $this->assertEquals($salesforceClient->getApiVersion(), '35.0');
    }
}
