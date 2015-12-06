<?php

namespace Devhelp\Salesforce\Method\SearchesAndQueries;

use Devhelp\Salesforce\Method\Base\Method;
use Devhelp\Salesforce\Method\Base\SearchMethodInterface;

/**
 * @author <michal@devhelp.pl>
 */
class GetFeedbackOnQueryPerformance extends Method implements SearchMethodInterface
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
            ->call('GET', sprintf('/services/data/v%s/query/?explain=%s', $apiVersion, $options['explain']), [
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
            'explain'
        ];
    }
}
