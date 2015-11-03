<?php

namespace Devhelp\Salesforce\Method;

/**
 * @author <michal@devhelp.pl>
 */
class CreateObject extends Method implements ObjectAuthorizedMethodInterface
{
    /**
     * {@inheritdoc}
     */
    public function run($authorization, $objectName, array $options)
    {
        $apiVersion = $this->salesforceClient->getApiVersion();

        $response =  $this->salesforceClient->call('POST', sprintf('/services/data/v%s/sobjects/%s/', $apiVersion, $objectName), [
            'headers' => [
                'authorization' => $authorization
            ],
            'json' => $options
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
