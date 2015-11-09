<?php

namespace Devhelp\Salesforce\Method\ObjectMetadata;

use Devhelp\Salesforce\Method\Base\Method;
use Devhelp\Salesforce\Method\Base\ObjectMethodInterface;

class GetObjectMetadataChanges extends Method implements ObjectMethodInterface
{
    /**
     * {@inheritdoc}
     */
    public function call($objectName, $authorization, array $options)
    {
        $apiVersion = $this->salesforceClient->getApiVersion();
        $this->validate($options);
        $response = $this
            ->salesforceClient
            ->call('GET', sprintf('/services/data/v%s/sobjects/%s/describe/', $apiVersion, $objectName), [
                'headers' => [
                    'authorization' => $authorization,
                    'IF_MODIFIED_SINCE' => $options['if-modified-since']

                ]
            ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    protected function getRequiredOptions()
    {
        return [
            'if-modified-since'
        ];
    }
}
