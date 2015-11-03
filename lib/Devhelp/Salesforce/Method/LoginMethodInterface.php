<?php

namespace Devhelp\Salesforce\Method;

/**
 * @author <michal@devhelp.pl>
 */
interface LoginMethodInterface
{
    /**
     * It runs non authorized method from salesforce rest api
     *
     * @param array $options
     * @return array
     */
    public function run(array $options);
}
