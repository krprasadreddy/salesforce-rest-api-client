<?php

namespace Devhelp\Salesforce\Method;

/**
 * @author <michal@devhelp.pl>
 */
interface ObjectAuthorizedMethodInterface
{
    /**
     * Run authorized method on salesforce object using rest api
     * It requires authorization key from Login Method and object name from salesforce
     *
     * @param string $authorization
     * @param string $objectName
     * @param array $options
     * @return mixed
     */
    public function run($authorization, $objectName, array $options);
}
