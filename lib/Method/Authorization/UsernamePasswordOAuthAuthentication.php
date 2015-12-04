<?php

namespace Devhelp\Salesforce\Method\Authorization;

use Devhelp\Salesforce\Method\Base\LoginMethodInterface;
use Devhelp\Salesforce\Method\Base\Method;

/**
 * @author <michal@devhelp.pl>
 */
class UsernamePasswordOAuthAuthentication extends Method implements LoginMethodInterface
{
    /**
     * {@inheritdoc}
     */
    public function call(array $options)
    {
        $this->validate($options);
        $response = $this->salesforceClient->call('POST', '/services/oauth2/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $options['client_id'],
                'client_secret' => $options['client_secret'],
                'username' => $options['username'],
                'password' => $options['password']
            ]
        ]);

        return $response;
    }

    /**
     * @return array
     */
    protected function getRequiredOptions()
    {
        return [
            'client_id',
            'client_secret',
            'username',
            'password'
        ];
    }
}
