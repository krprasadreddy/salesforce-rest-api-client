<?php

namespace Devhelp\Salesforce\Method\SearchesAndQueries;

use Devhelp\Salesforce\Method\Base\Method;
use Devhelp\Salesforce\Method\Base\SearchMethodInterface;

/**
 * @author <michal@devhelp.pl>
 */
class GetTheDefaultSearchScopeAndOrder extends Method implements SearchMethodInterface
{
    /**
     * {@inheritdoc}
     */
    public function call($authorization, array $options = [])
    {
        $apiVersion = $this->salesforceClient->getApiVersion();
        $response = $this
            ->salesforceClient
            ->call('GET', sprintf('/services/data/v%s/search/scopeOrder', $apiVersion), [
                'headers' => [
                    'authorization' => $authorization
                ]
            ]);

        return $response;
    }
}
