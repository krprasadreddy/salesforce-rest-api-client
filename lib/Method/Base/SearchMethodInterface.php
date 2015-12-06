<?php

namespace Devhelp\Salesforce\Method\Base;

use Devhelp\Salesforce\Exception\SalesforceRestApiException;
use Psr\Http\Message\ResponseInterface;

/**
 * @author <michal@devhelp.pl>
 */
interface SearchMethodInterface extends MethodInterface
{
    /**
     * @param string $authorization
     * @param array $options
     * @return ResponseInterface|SalesforceRestApiException
     */
    public function call($authorization, array $options = []);
}
