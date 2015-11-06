<?php

namespace Devhelp\Salesforce\Method\Base;

/**
 * @author <michal@devhelp.pl>
 */
interface ObjectMethodInterface extends MethodInterface
{
    /**
     *
     * @param string $objectName
     * @param string $authorization
     * @param array $options
     * @return array
     */
    public function call($objectName, $authorization, array $options);
}
