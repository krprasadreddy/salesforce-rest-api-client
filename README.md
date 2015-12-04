#Salesforce Rest API Client

[![Code Climate](https://codeclimate.com/github/devhelp/salesforce-rest-api-client/badges/gpa.svg)](https://codeclimate.com/github/devhelp/salesforce-rest-api-client)
[![Build Status](https://travis-ci.org/devhelp/salesforce-rest-api-client.svg)](https://travis-ci.org/devhelp/salesforce-rest-api-client)
[![Coverage Status](https://coveralls.io/repos/devhelp/salesforce-rest-api-client/badge.svg?branch=master&service=github)](https://coveralls.io/github/devhelp/salesforce-rest-api-client?branch=master)
[![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)

Salesforce Rest Api Client allows you to use rest api client and run salesforce method (endpoints).
This component is based on documentation available on link
[![Salesforce Rest Api documentation]](https://resources.docs.salesforce.com/sfdc/pdf/api_rest.pdf)

Salesforce Rest Api Client provides basic methods
* Login
* Run SOQL queries
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
