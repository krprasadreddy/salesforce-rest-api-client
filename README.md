#Salesforce Rest Client

```php

    use Devhelp\Salesforce\Client\SalesforceClientFactory;
    use Devhelp\Salesforce;

    $salesforceClient = (new SalesforceClientFactory())->getClient();

    $method = new Method\Login($salesforceClient);

    $response = $method->run([
        'grant_type' => 'password',
        'client_id' => 'client_id',
        'client_secret' => 'client_secret',
        'username' => 'user@example.com',
        'password' => 'passwordwithsecret'
    ]);

    $salesforceClient = (new SalesforceClientFactory($response['instance_url']))->getClient();

    $method = new Method\CreateObject($salesforceClient);

    $response = $method->run($response['token_type'] . ' ' . $response['access_token'], 'Account', [
        'Name' => 'New Account Name'
    ]);
    
```    
