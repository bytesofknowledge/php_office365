# Office 365 OAuth2 client credential flow Example in PHP
--

### Description

This is a sample illustrating how to implement the client credential OAuth flow in PHP. The app allows an administrator to login and give consent. Once consent is given the logged in user can view inbox emails and upcoming calendar events of any user in the organization.

Requirements:  
- PHP 5.2.x or higher [http://www.php.net/]  
- PHP Curl extension [http://www.php.net/manual/en/intro.curl.php]  
- PHP JSON extension [http://php.net/manual/en/book.json.php]  
- Composer [https://getcomposer.org/]
- ramsey/uuid for PHP [https://github.com/ramsey/uuid]

[Composer][] and [ramsey/uuid][] are not required. [ramsey/uuid][] is used in the example to create version 4 (random) UUID objects. These random objects are used as the nonce for the api calls.

### Running the Example

1. Download or fork the sample project.
1. [Register the app in Azure Active Directory](https://github.com/jasonjoh/office365-azure-guides/blob/master/RegisterAnAppInAzure.md). The app should be registered as a web app with a Sign-on URL that matches the url of your development environment. IE: http://127.0.0.1/
1. Set the Reply Url to the url of your development environment /get_consent. IE: http://127.0.0.1/get_consent.
1. In the permissions to other applications section give the Office 365 Exchange Online application permission to "Read and write calendars in all mailboxes" and "Read mail in all mailboxes."

1. Configure an X509 certificate for your app following the directions [here](http://blogs.msdn.com/b/exchangedev/archive/2015/01/21/building-demon-or-service-apps-with-office-365-mail-calendar-and-contacts-apis-oauth2-client-credential-flow.aspx).
1. Extract the private key in RSA format from your certificate and save it to a PEM file. You can use openssl to do this: `openssl pkcs12 -in <path to PFX file> -nodes -nocerts -passin pass:<cert password> | openssl rsa -out appcert.pem'`

1. Add the private key .PEM file to office365/certificates/
1. Open the file index.php and set the Client Id, Secret, Thumbprint.
	1. Set the ClientId to the application Client id.
	1. Set the Secret to the secret key generated when you created the application.
	1. Set the Thumbprint to the thumbprint key you created when you configured the X509 certificate.
	1. Set the AuthorizationRedirectUrl to the Reply Url you set in the application. IE: http://127.0.0.1/get_consent
1. If you named your private key .PEM file something other than appcert.PEM open the file office365/Office365.php and change the static variable $privateKeyFileName to the name of your certificate.

1. Install [Composer][] and [ramsey/uuid][]. If you do not want to include [Composer][] and [ramsey/uuid][] in the project then go to the file office365/ApiResource.php and modify the method nonce() to return a custom nonce string.
To install [Composer][] and [ramsey/uuid][] navigate to the root folder of the project. In your command prompt and run the following command to install [Composer][].
`curl -sS https://getcomposer.org/installer | php -- --install-dir=bin`
Once [Composer][] is installed run the following command to include the [ramsey/uuid][] project.
`composer require ramsey/uuid`

1. Start your development server and enter the url to the root url. IE: http://127.0.0.1/
1. Click the link "Connect Me!" and login using an administrative account. Once logged in you will be redirected back to the development site. You will see a link to Email and Calendar. 
1. On the Email page enter a valid email address for a user in the Office 365 tenant and click the "Submit" button. You will receive a response of the most recent 10 emails for the user.
1. On the Calendar page enter a valid email address for a user in the Office 365 tenant and click the "Submit" button. You will receive a response of all calendar events in the next 30 days for the user.

----------
Connect with me on Twitter [@marknelsondev](https://twitter.com/marknelsondev)

[composer]: http://getcomposer.org/
[ramsey/uuid]: https://github.com/ramsey/uuid
