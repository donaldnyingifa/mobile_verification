# MobileVerificationApplication

Mobile Verification application is an application that allows users who are looking to purchase a used phone to search for the ownership of the phone online using the IMEI number.

User roles: There are three types of users - 
Unregistered User: As an unregistered user, I can search for a phone using the IMEI number without registering or logging in.
Registered User: As a registered user, I can search for a phone and add phones to the database. I can also view, edit and delete only the phones I have registered.
Admin User: As an admin user, I can view, edit and delete all the phones on the database. I can also change a user role from regular to admin.


# Sample IMEI to Search

12341234 (REPORTED STOLEN)

12345678

# To login online

https://mobilever123.000webhostapp.com/

As admin
Email: john@gmail.com
Password: 123

As Regular User
Email: jane@gmail.com
Password: 123

# To run app on local host

Make sure you have PHP 7.3.11 or higher installed on your system.
Put all the files inside htdocs then visit http://localhost/index.php on your browser.

# To run Tests

./vendor/bin/phpunit
