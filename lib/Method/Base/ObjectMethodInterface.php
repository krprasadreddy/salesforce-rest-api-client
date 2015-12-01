<?php

namespace Devhelp\Salesforce\Method\Base;

use Psr\Http\Message\ResponseInterface;

/**
 * @author <michal@devhelp.pl>
 */
interface ObjectMethodInterface extends MethodInterface
{
    /**
     * @param string $objectName
     * @param string $authorization
     * @param array $options
     * @return ResponseInterface
     */
    public function call($objectName, $authorization, array $options);
}
