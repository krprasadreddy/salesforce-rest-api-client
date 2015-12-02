<?php

namespace Devhelp\Salesforce\Method\Base;

use Devhelp\Salesforce\Client\SalesforceClientInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author <michal@devhelp.pl>
 */
abstract class Method
{
    /**
     * @var SalesforceClientInterface
     */
    protected $salesforceClient;

    /**
     * @var OptionsResolver
     */
    protected $optionResolver;

    /**
     * @param SalesforceClientInterface $salesforceClient
     */
    public function __construct(SalesforceClientInterface $salesforceClient)
    {
        $this->salesforceClient = $salesforceClient;
        $this->optionResolver = new OptionsResolver();
    }

    /**
     * @param array $options
     */
    protected function validate(array $options)
    {
        $this->optionResolver->setRequired($this->getRequiredOptions());
        $this->optionResolver->resolve($options);
    }

    /**
     * @return array
     */
    protected function getRequiredOptions()
    {
        return [];
    }
}
