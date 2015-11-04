<?php

namespace Devhelp\Salesforce\Method;

use Devhelp\Salesforce\Client\SalesforceClientInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author <michal@devhelp.pl>
 */
class Login extends Method implements LoginMethodInterface
{
    const URI = '/services/oauth2/token';
    const METHOD = 'POST';

    /**
     * @var OptionsResolver
     */
    private $optionResolver;

    public function __construct(SalesforceClientInterface $clientInterface)
    {
        parent::__construct($clientInterface);
        $this->optionResolver = new OptionsResolver();
    }

    /**
     * {@inheritdoc}
     */
    public function run(array $options)
    {
        $this->optionResolver->setRequired([
            'grant_type',
            'client_id',
            'client_secret',
            'username',
            'password'
        ]);

        $this->optionResolver->resolve($options);

        $response = $this->salesforceClient->call(self::METHOD, self::URI, [
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
}
