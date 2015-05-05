# Office 365 OAuth2 client credential flow Example in PHP
--

### Description

This is a sample illustrating how to implement the client credential OAuth flow in PHP. The app allows an administrator to login and give consent. Once consent is given the logged in user can view inbox emails and upcoming calendar events of any user in the organization.

Requirements:  
1) PHP 5.2.x or higher [http://www.php.net/]  
2) PHP Curl extension [http://www.php.net/manual/en/intro.curl.php]  
3) PHP JSON extension [http://php.net/manual/en/book.json.php]  
4) Composer [https://getcomposer.org/]
5) ramsey/uuid for PHP [https://github.com/ramsey/uuid]

[Composer][] and [ramsey/uuid][] are not required. [ramsey/uuid][] is used in the example to create version 4 (random) UUID objects. These random objects are used as the nonce for the api calls.

### Running the Example

1) Download or fork the sample project.
2) [Register the app in Azure Active Directory](https://github.com/jasonjoh/office365-azure-guides/blob/master/RegisterAnAppInAzure.md). The app should be registered as a web app with a Sign-on URL that matches the url of your development environment. IE: http://127.0.0.1/, 
3) Set the Reply Url to the url of your development environment /get_consent. IE: http://127.0.0.1/get_consent.
4) In the permissions to other applications section give the Office 365 Exchange Online application permission to "Read and write calendars in all mailboxes" and "Read mail in all mailboxes."

5) Configure an X509 certificate for your app following the directions [here](http://blogs.msdn.com/b/exchangedev/archive/2015/01/21/building-demon-or-service-apps-with-office-365-mail-calendar-and-contacts-apis-oauth2-client-credential-flow.aspx).
6) Extract the private key in RSA format from your certificate and save it to a PEM file. You can use openssl to do this: 'openssl pkcs12 -in <path to PFX file> -nodes -nocerts -passin pass:<cert password> | openssl rsa -out appcert.pem'

7) Add the private key .PEM file to office365/certificates/
8) Open the file index.php and set the Client Id, Secret, Thumbprint.
	1. Set the ClientId to the application Client id.
	1. Set the Secret to the secret key generated when you created the application.
	1. Set the Thumbprint to the thumbprint key you created when you configured the X509 certificate.
	1. Set the AuthorizationRedirectUrl to the Reply Url you set in the application. IE: http://127.0.0.1/get_consent
9) If you named your private key .PEM file something other than appcert.PEM open the file office365/Office365.php and change the static variable $privateKeyFileName to the name of your certificate.

10) Install [Composer][] and [ramsey/uuid][]. If you do not want to include [Composer][] and [ramsey/uuid][] in the project then go to the file office365/ApiResource.php and modify the method nonce() to return a custom nonce string.
To install [Composer][] and [ramsey/uuid][] navigate to the root folder of the project in your command prompt and run the following command to install [Composer][] and the [ramsey/uuid][] package.
```bash

```curl -sS https://getcomposer.org/installer | php -- --install-dir=bin

Once [Composer][] is installed run the following command to include the [ramsey/uuid][] project.
```bash

```composer require ramsey/uuid

11) Start your development server and enter the url to the root url. IE: http://127.0.0.1/
12) Click the link "Connect Me!" and login using an administrative account. Once logged in you will be redirected back to the development site. You will see a link to Email and Calendar. 
13) On the Email page enter a valid email address for a user in the Office 365 tenant and click the "Submit" button. You will receive a response of the most recent 10 emails for the user.
14) On the Calendar page enter a valid email address for a user in the Office 365 tenant and click the "Submit" button. You will receive a response of all calendar events in the next 30 days for the user.

----------
Connect with me on Twitter [@marknelsondev](https://twitter.com/marknelsondev)

[composer]: http://getcomposer.org/
[ramsey/uuid]: https://github.com/ramsey/uuid
