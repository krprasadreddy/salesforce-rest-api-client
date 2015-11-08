#Salesforce Rest API Client

[![Code Climate](https://codeclimate.com/github/devhelp/salesforce-rest-api-client/badges/gpa.svg)](https://codeclimate.com/github/devhelp/salesforce-rest-api-client)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/devhelp/salesforce-rest-api-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/devhelp/salesforce-rest-api-client/?branch=master)
[![Build Status](https://travis-ci.org/devhelp/salesforce-rest-api-client.svg)](https://travis-ci.org/devhelp/salesforce-rest-api-client)
[![Coverage Status](https://coveralls.io/repos/devhelp/salesforce-rest-api-client/badge.svg?branch=master&service=github)](https://coveralls.io/github/devhelp/salesforce-rest-api-client?branch=master)
[![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)


Salesforce Rest Api Client provides basic methods
* Login 
* Get record
* Create record
* Update record
* Delete record
* Retrieve metadata object
* Handling basic errors


###Login example

```php
    use Devhelp\Salesforce\Client\SalesforceClientFactory;
    use Devhelp\Salesforce;

    $salesforceClient = (new SalesforceClientFactory())->getClient();

    $method = new Method\Authorization\Login($salesforceClient);

    $response = $method->call([
        'grant_type' => 'password',
        'client_id' => 'client_id',
        'client_secret' => 'client_secret',
        'username' => 'user@example.com',
        'password' => 'passwordwithsecret'
    ]);
    
    $instanceUrl = $response['instance_url'];
    $accessToken = $response['token_type'] . ' ' . $response['access_token'];
```    

###Create record example

```php
    //$instanceUrl should be taken from Login method response 
    $salesforceClient = (new SalesforceClientFactory($instanceUrl))->getClient();
    $method = new Method\Records\CreateARecord($salesforceClient);
    //$accessToken should be taken from Login method response
    $response = $method->call('Account', $accessToken, [
        'Name' => 'New Account Name'
    ]);
```  
