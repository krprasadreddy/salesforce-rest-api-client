<?php

namespace Devhelp\Salesforce\Method\Authorization;

use Devhelp\Salesforce\Method\Base\LoginMethodInterface;
use Devhelp\Salesforce\Method\Base\Method;

/**
 * @author <michal@devhelp.pl>
 */
class Login extends Method implements LoginMethodInterface
{
    /**
     * {@inheritdoc}
     */
    public function call(array $options)
    {
        $this->validate($options);
        $response = $this->salesforceClient->call('POST', '/services/oauth2/token', [
            'form_params' => [
                'grant_type' => $options['grant_type'],
                'client_id' => $options['client_id'],
                'client_secret' => $options['client_secret'],
                'username' => $options['username'],
                'password' => $options['password']
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    protected function getRequiredOptions()
    {
        return [
            'grant_type',
            'client_id',
            'client_secret',
            'username',
            'password'
        ];
    }
}
