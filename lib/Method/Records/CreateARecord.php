<?php

namespace Devhelp\Salesforce\Method\Records;

use Devhelp\Salesforce\Method\Base\Method;
use Devhelp\Salesforce\Method\Base\ObjectMethodInterface;

/**
 * @author <michal@devhelp.pl>
 */
class CreateARecord extends Method implements ObjectMethodInterface
{
    /**
     * {@inheritdoc}
     */
    public function call($objectName, $authorization, array $options)
    {
        $apiVersion = $this->salesforceClient->getApiVersion();
        $response = $this
            ->salesforceClient
            ->call('POST', sprintf('/services/data/v%s/sobjects/%s/', $apiVersion, $objectName), [
                'headers' => [
                    'authorization' => $authorization
                ],
                'json' => $options
            ]);

        return $response;
    }
}
