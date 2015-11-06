<?php

namespace Devhelp\Salesforce\Method\Base;

/**
 * @author <michal@devhelp.pl>
 */
interface LoginMethodInterface extends MethodInterface
{
    /**
     * It runs non authorized method from salesforce rest api
     *
     * @param array $options
     * @return array
     */
    public function call(array $options);
}
