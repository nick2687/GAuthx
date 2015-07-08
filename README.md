# GAuthx

Description
------

This Modx Extra enables use of the Google Authenticator mobile app for 2-factor-authentication in conjunction with  Shaun McCormick's Login Snippet (https://github.com/splittingred/Login). This Extra contains two snippets, one to generate secrets and present a QR-Code for scanning the secret. The other is used as a Login PreHook to validate codes when a user attempts to login.

The system also includes a class for preventing replay-attack's by making sure that previously used codes cannot be reused. 

## Installing GAuthx

You can install GAuthx via the standard MODx package manager.

GAuthx Snippet
------

GAuthx creates a new Auth Secret for the currently logged in user, and provides them with a QR Code that can be scanned by any 2 Factor Authentication app. 

Once the QR Code or Auth Secret has been inputed into the app, the user must then validate the token is set up correctly and working by using the supplied validation form. If the token supplied by the user validates, the auth secret will then be accociated with that users account and they will be required to use their authentication token upon each login going forward. 

## Snippet Usage:

```
[[!GAuthx? &responseTpl=`GAuthxResponseTpl` &tpl=`GAuthxTpl`]] 
```

## Properties - GAuthx
GAuthx only has two available properties currently.

* responseTpl (optional) : Chunk name used to format the response message
* tpl (optional) : Chunk name used to format QR Code and Verification Form



# GAuthxHook



## Properties - GAuthxHook



### Development / Credits

* Author: Nick Clark, (@nick2687)
* Licensed under the GNU License.
* Credit: Thanks go to Michael Kliewe, (@PHPGangsta) who wrote the GoogleAuthenticator class this Modx Extra uses.
* Dependancies: Login - https://github.com/splittingred/Login
