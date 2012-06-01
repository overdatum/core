# Getting Started

By far the easiest way to start working with our API is to use the wrapper for your language of choice. They take care of most of the heavy lifting for you. Once you've downloaded the wrapper, the next thing you'll need is your API account.

## Grab a wrapper
Our wrappers are going to make your job so much easier. Right now we only have a wrapper available for PHP, but we are planning to add others soon, go and grab it now, then head back here.

## Get your API credentials
You can create a API user by logging into your account and clicking on the "Accounts" link on the left side of your screen. If you havn't already done so, you'll need to click the "Add account" button on the bottom right of your screen. After that, just enter an email address and password, select a Role to define what parts of the API can be accessed. Now all that is remained to do is to click on the big "Add Account" button.

For lots of you, having the wrapper of choice at your disposal and your API credentials will be enough to get started. next up, select the area of the API you'd like to work with (such as Accounts, Pages, etc) in the menu on the left. For those looking at rolling their own solution or interested in learning more about how the API works, we've expanded on that below.

<a name="authentication"></a>
## Authentication
The Layla API uses HTTP Basic Authentication to authenticate requests. When you make an API request you provide your API account's email and password.

To demonstrate authentication with the API, you can make any GET request to the API directly in your web browser. So for example, if you wanted to get a list of all your accounts, you would enter the following into your address bar:

> http://api.getlayla.com/v1/account/all

Your browser should then display a dialog requesting that you enter a username and password. Enter your email address in the username field. and the password in the password field (pretty obvious, right?) If your request is authenticated, you should then be delivered the JSON response.

You are also able to test calls using a command line tool like cURL (which will also allow you to make requests which require the use of the POST, PUT and DELETE HTTP verbs).

This is the equivalent way of authenticating using cURL, rather than your web browser:

> curl -u "we@getlayla.com:canttellyou" http://api.getlayla.com/v1/account/all -v

Your HTTP request should look similar to:

<pre>
GET /v1/account/all HTTP/1.1
</pre>

And you should receive a HTTP response similar to:

<pre>
HTTP/1.1 200 OK
Cache-Control: private, s-maxage=0
Content-Type: application/json; charset=utf-8
Date: Thu, 16 Sep 2010 06:33:42 GMT

{"results":[{"id":3,"email":"k.schmeets@gmail.com","name":"Koen Schmeets","created_at":"2012-05-31 01:49:51","updated_at":"2012-05-31 01:49:51","roles":[{"id":1,"name":"admin","lang":{"id":1,"role_id":1,"name":"Admin","description":"Dee maag alles dee jong..."},"pivot":{"connection":null,"id":11,"created_at":"2012-05-31 01:49:51","updated_at":"2012-05-31 01:49:51","account_id":3,"role_id":1}}],"language":{"id":1,"name":"English"}}],"total":1,"pages":1}
</pre>

<a name="input-output"></a>
## Input & Output
Input and output is currently supported in JSON only. When you make an API request, you must specify a data format as part of the route, which represents both the data format in which you are sending content in the body of the request (this is only required for specific POST and PUT requests) and also the format in which you expect to receive output in the body of the response.

When providing input you must ensure that your JSON is well-formed and complies with the syntax paying particular attention to character and entity encoding with both formats. Any input provided in the query string of any request should be url-encoded. An example of where this is required is the request for getting a subscriber's details which takes an email address as a query string parameter.

<a name="providing-input"></a>
## Providing input

EXAMPLE Creating an account

To create a account using JSON as the input data format, you would make a HTTP POST request as follows:

<pre>
POST http://api.getlayla.com/v1/account
{
  "name": "Koen Schmeets",
  "email": "koen@getlayla.com",
  "password": "canttellyou",
  "language_id": 1,
  "roles": [1,3]
}
</pre>

<a name="getting-output"></a>
## Getting output

EXAMPLE Getting a list of accounts

To get a list of clients in JSON format, you would make a HTTP GET request. You'll receive a response in JSON format similar to the following:

<pre>
GET http://api.getlayla.com/v1/account/all
{"results":[{"id":3,"email":"k.schmeets@gmail.com","name":"Koen Schmeets","created_at":"2012-05-31 01:49:51","updated_at":"2012-05-31 01:49:51","roles":[{"id":1,"name":"admin","lang":{"id":1,"role_id":1,"name":"Admin","description":"Dee maag alles dee jong..."},"pivot":{"connection":null,"id":11,"created_at":"2012-05-31 01:49:51","updated_at":"2012-05-31 01:49:51","account_id":3,"role_id":1}}],"language":{"id":1,"name":"English"}}],"total":1,"pages":1}
</pre>

The Content-Type header of the response will be set to "application/json; charset=utf-8".

<a name="response-status-codes"></a>
## Response status codes
The responses returned by the API are accompanied by meaningful HTTP status codes which represent the status of the request. Here's the general approach we take when returning responses:

### Success:

**GET** requests will return a "**200 OK**" response if the resource is successfully retrieved.

**POST** requests which create a resource we will return a "**201 Created**" response if successful.

**POST** requests which perform some other action such as sending a campaign will return a "200 OK" response if successful.

**PUT** requests will return a "**200 OK**" response if the resource is successfully updated.

**DELETE** requests will return a "**200 OK**" response if the resource is successfully deleted.

### Errors:

If you attempt to authenticate with an invalid API user or you attempt to use an invalid id for a resource, you'll received a "**401 Unauthorized**" response.

#### Example response body: 401 Unauthorized
TODO

####Example response body: 400 Bad Request
TODO

If you attempt to request a resource which doesn't exist, you'll receive a "**404 Not Found**" response.

#### Response body: 404 Not Found
TODO

If an unhandled error occurs on the API server for some reason, you'll receive a "**500 Internal Server Error**" response.

#### Response body: 500 Internal Server Error
TODO

<a name="secure-access"></a>
## Secure Access
All API requests can be made using either http or https. We do not enforce the use of https on any requests, though we do highly recommend that you use https for all requests if possible.

<a name="making-things-pretty"></a>
## Making things pretty
You can add pretty=true to the query string of any request if you want the output to be indented in a nice human-readable format.

So, the following request without the pretty parameter:

> http://api.getlayla.com/v1/account/all
Would produce output similar to
<pre>
{"results":[{"id":3,"email":"k.schmeets@gmail.com","name":"Koen Schmeets","created_at":"2012-05-31 01:49:51","updated_at":"2012-05-31 01:49:51","roles":[{"id":1,"name":"admin","lang":{"id":1,"role_id":1,"name":"Admin","description":"Dee maag alles dee jong..."},"pivot":{"connection":null,"id":11,"created_at":"2012-05-31 01:49:51","updated_at":"2012-05-31 01:49:51","account_id":3,"role_id":1}}],"language":{"id":1,"name":"English"}}],"total":1,"pages":1}
</pre>

And the following request including pretty=true

> http://api.getlayla.com/v1/account/all?pretty=true
Would produce output similar to
<pre>
{
   "results":[
      {
         "id":3,
         "email":"k.schmeets@gmail.com",
         "name":"Koen Schmeets",
         "created_at":"2012-05-31 01:49:51",
         "updated_at":"2012-05-31 01:49:51",
         "roles":[
            {
               "id":1,
               "name":"admin",
               "lang":{
                  "id":1,
                  "role_id":1,
                  "name":"Admin",
                  "description":"Dee maag alles dee jong..."
               },
               "pivot":{
                  "connection":null,
                  "id":11,
                  "created_at":"2012-05-31 01:49:51",
                  "updated_at":"2012-05-31 01:49:51",
                  "account_id":3,
                  "role_id":1
               }
            }
         ],
         "language":{
            "id":1,
            "name":"English"
         }
      }
   ],
   "total":1,
   "pages":1
}
</pre>
