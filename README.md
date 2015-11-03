#Salesforce Rest Client

[![Code Climate](https://codeclimate.com/github/devhelp/salesforce-rest-api-client/badges/gpa.svg)](https://codeclimate.com/github/devhelp/salesforce-rest-api-client)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/devhelp/salesforce-rest-api-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/devhelp/salesforce-rest-api-client/?branch=master)
[![Build Status](https://travis-ci.org/devhelp/salesforce-rest-api-client.svg)](https://travis-ci.org/devhelp/salesforce-rest-api-client)
[![Coverage Status](https://coveralls.io/repos/devhelp/salesforce-rest-api-client/badge.svg?branch=master&service=github)](https://coveralls.io/github/devhelp/salesforce-rest-api-client?branch=master)
[![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)

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
