<?php

namespace Devhelp\Salesforce\Method\SearchesAndQueries;

use Devhelp\Salesforce\Method\Base\Method;
use Devhelp\Salesforce\Method\Base\SearchMethodInterface;

/**
 * @author <michal@devhelp.pl>
 */
class ExecuteASoqlQueryWithDeletedItems extends Method implements SearchMethodInterface
{
    /**
     * {@inheritdoc}
     */
    public function call($authorization, array $options)
    {
        $apiVersion = $this->salesforceClient->getApiVersion();
        $response = $this
            ->salesforceClient
            ->call('GET', sprintf('/services/data/v%s/queryAll/?q=%s', $apiVersion, $options['q']), [
                'headers' => [
                    'authorization' => $authorization
                ]
            ]);

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    protected function getRequiredOptions()
    {
        return [
            'q'
        ];
    }
}
