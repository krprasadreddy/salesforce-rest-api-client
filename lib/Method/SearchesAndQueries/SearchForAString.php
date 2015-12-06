<?php

namespace Devhelp\Salesforce\Method\SearchesAndQueries;

use Devhelp\Salesforce\Method\Base\Method;
use Devhelp\Salesforce\Method\Base\SearchMethodInterface;

/**
 * @author <michal@devhelp.pl>
 */
class SearchForAString extends Method implements SearchMethodInterface
{
    /**
     * {@inheritdoc}
     */
    public function call($authorization, array $options = [])
    {
        $this->validate($options);
        $apiVersion = $this->salesforceClient->getApiVersion();
        $response = $this
            ->salesforceClient
            ->call('GET', sprintf('/services/data/v%s/search/?q=%s', $apiVersion, urlencode($options['q'])), [
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
