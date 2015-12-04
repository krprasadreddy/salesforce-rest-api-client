<?php

namespace Devhelp\Salesforce\Method\Authorization;

use Devhelp\Salesforce\Method\Base\LoginMethodInterface;
use Devhelp\Salesforce\Method\Base\Method;

/**
 * @author <michal@devhelp.pl>
 */
class WebServerOAuthAuthentication extends Method implements LoginMethodInterface
{
    /**
     * {@inheritdoc}
     */
    public function call(array $options)
    {
        $this->validate($options);
        $response = $this->salesforceClient->call('POST', '/services/oauth2/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => $options['client_id'],
                'client_secret' => $options['client_secret'],
                'redirect_uri' => $options['redirect_uri'],
                'code' => $options['code']
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
            'redirect_uri',
            'code'
        ];
    }
}
