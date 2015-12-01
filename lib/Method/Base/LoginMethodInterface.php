<?php

namespace Devhelp\Salesforce\Method\Base;

use Psr\Http\Message\ResponseInterface;

/**
 * @author <michal@devhelp.pl>
 */
interface LoginMethodInterface extends MethodInterface
{
    /**
     * It runs non authorized method from salesforce rest api
     *
     * @param array $options
     * @return ResponseInterface
     */
    public function call(array $options);
}
