<?php

namespace Devhelp\Salesforce\Method;

use Devhelp\Salesforce\Client\SalesforceClientInterface;

/**
 * @author <michal@devhelp.pl>
 */
abstract class Method
{
    /**
     * @var SalesforceClientInterface
     */
    protected $salesforceClient;

    public function __construct(SalesforceClientInterface $salesforceClient)
    {
        $this->salesforceClient = $salesforceClient;
    }
}
