# Salesforce Rest API Client

* [Installation] (#installation)
* [Usage] (#usage)
    * [Authentication] (#authentication)
        * [Web Server OAuth Authentication] (#web-server-oauth-authentication)
        * [Username-Password OAuth Authentication] (#username-password-oauth-authentication)
    * [Searches and Queries] (#searches-and-queries)
        * [Execute a SOQL Query] (#execute-a-soql-query)
        * [Execute a SOQL Query that Includes Deleted Items] (#execute-a-soql-query-that-includes-deleted-items)
        * [Get Feedback on Query Performance] (#get-feedback-on-query-performance)
        * [Search for a String] (#search-for-a-string)
        * [Get the Default Search Scope and Order] (#get-the-default-search-scope-and-order)
    * [Handling errors] (#handling-errors)
* [Testing] (#testing)
    * [Using Method Test Case] (#using-test-case)
    
## Installation

```sh
$ composer require devhelp/salesforce-rest-api-client
```

## Usage

### Authentication

To run authentication methods you need to configure application on Salesforce Panel. 
More details available [here] (https://developer.salesforce.com/docs/atlas.en-us.api_rest.meta/api_rest/intro_defining_remote_access_applications.htm)
After configuring the application you can find fileds `client_id`, `client_secret`, `redirect_uri` and use those on authentication methods.

#### Web Server OAuth Authentication

More information about authentication you can find [here] (https://developer.salesforce.com/page/Inside_OpenID_Connect_on_Force.com) 
or in Salesforce Rest API documentation. 

```php
use Devhelp\Salesforce\Client\SalesforceClientFactory;
use Devhelp\Salesforce\Method;

$salesforceClient = (new SalesforceClientFactory())->getClient();
$method = new Method\Authentication\WebServerOAuthAuthentication($salesforceClient);

$response = $method->call([
    'client_id' => '3MVG9Rd3qC6oMalP7QOImRZCzLssDMXW3wXinwkdU78P884FfubCsyxWY1bFBjjGsd1jL.P7vTMRCWwcXidZO',
    'client_secret' => '4324321344342343243',
    'code' => 'fdsfdsFFDFDSFDSU4F7hnL7L_2ptP_dWJ1OezBouF5.t4gne0.0R.dmWrkceHw==',
    'redirect_uri' => 'https://oauth-redirect-url.example.com'
]);

```

#### Username-Password OAuth Authentication

```php
use Devhelp\Salesforce\Client\SalesforceClientFactory;
use Devhelp\Salesforce\Method;

$salesforceClient = (new SalesforceClientFactory())->getClient();
$method = new Method\Authentication\UsernamePasswordOAuthAuthentication($salesforceClient);
$response = $method->call([
    'client_id' => '3MVG9Rd3qC6oMalP7QOImRZCzLssDMXW3wXinwkdU78P884FfubCsyxWY1bFBjjGsd1jL.P7vTMRCWwcXidZO',
    'client_secret' => '4324321344342343243',
    'username' => 'salesforce@example.com',
    'password' => 'passwordwithtoken'
]);
```
### Searches and Queries

#### Execute a SOQL Query

```php
use Devhelp\Salesforce\Client\SalesforceClientFactory;
use Devhelp\Salesforce\Method;

//$response from authentication method
$responseData = json_decode($response->getBody()->getContents(), true); 

$salesforceClient = (new SalesforceClientFactory($responseData['instance_url']))->getClient();

$method = new Method\SearchesAndQueries\ExecuteASoqlQuery($salesforceClient);

$response = $method->call($responseData['token_type']. ' ' .$responseData['access_token'], [
   'q' => 'SELECT+name+from+Account'
]);
```

#### Execute a SOQL Query that Includes Deleted Items

```php
use Devhelp\Salesforce\Client\SalesforceClientFactory;
use Devhelp\Salesforce\Method;

//$response from authentication method
$responseData = json_decode($response->getBody()->getContents(), true);

$salesforceClient = (new SalesforceClientFactory($responseData['instance_url']))->getClient();

$method = new Method\SearchesAndQueries\ExecuteASoqlQueryWithDeletedItems($salesforceClient);

$response = $method->call($responseData['token_type']. ' ' .$responseData['access_token'], [
   'q' => 'SELECT+name+from+Account+WHERE+isDeleted+=+TRUE'
]);
```

#### Execute a SOQL Query that Includes Deleted Items

```php
use Devhelp\Salesforce\Client\SalesforceClientFactory;
use Devhelp\Salesforce\Method;

//$response from authentication method
$responseData = json_decode($response->getBody()->getContents(), true);

$salesforceClient = (new SalesforceClientFactory($responseData['instance_url']))->getClient();

$method = new Method\SearchesAndQueries\ExecuteASoqlQueryWithDeletedItems($salesforceClient);

$response = $method->call($responseData['token_type']. ' ' .$responseData['access_token'], [
   'q' => 'SELECT+name+from+Account+WHERE+isDeleted+=+TRUE'
]);
```

#### Get Feedback on Query Performance

```php
use Devhelp\Salesforce\Client\SalesforceClientFactory;
use Devhelp\Salesforce\Method;

//$response from authentication method
$responseData = json_decode($response->getBody()->getContents(), true);

$salesforceClient = (new SalesforceClientFactory($responseData['instance_url']))->getClient();

$method = new Method\SearchesAndQueries\GetFeedbackOnQueryPerformance($salesforceClient);

$response = $method->call($responseData['token_type']. ' ' .$responseData['access_token'], [
   'explain' => 'SELECT+name+from+Account'
]);
```

#### Search for a String

For this method we are using [SOSL] (https://developer.salesforce.com/docs/atlas.en-us.soql_sosl.meta/soql_sosl/sforce_api_calls_sosl_about.htm)
language

```php
use Devhelp\Salesforce\Client\SalesforceClientFactory;
use Devhelp\Salesforce\Method;

//$response from authentication method
$responseData = json_decode($response->getBody()->getContents(), true);

$salesforceClient = (new SalesforceClientFactory($responseData['instance_url']))->getClient();

$method = new Method\SearchesAndQueries\SearchForAString($salesforceClient);

$response = $method->call($responseData['token_type']. ' ' .$responseData['access_token'], [
   'q' => 'FIND {searching text}'
]);
```

#### Get the Default Search Scope and Order

```php
use Devhelp\Salesforce\Client\SalesforceClientFactory;
use Devhelp\Salesforce\Method;

//$response from authentication method
$responseData = json_decode($response->getBody()->getContents(), true);

$salesforceClient = (new SalesforceClientFactory($responseData['instance_url']))->getClient();

$method = new Method\SearchesAndQueries\GetTheDefaultSearchScopeAndOrder($salesforceClient);

$response = $method->call($responseData['token_type']. ' ' .$responseData['access_token']);
```
