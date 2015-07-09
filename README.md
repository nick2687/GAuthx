# GAuthx

This Modx Extra enables use of the Google Authenticator mobile app for 2-factor-authentication in conjunction with  Shaun McCormick's Login Snippet (https://github.com/splittingred/Login). This Extra contains two snippets, one to generate secrets and present a QR-Code for scanning the secret. The other is used as a Login PreHook to validate codes when a user attempts to login.

The system also includes a class for preventing replay-attack's by making sure that previously used codes cannot be reused. 

### Installing GAuthx

You can install GAuthx via the standard MODx package manager.

## GAuthx Snippet


GAuthx creates a new Auth Secret for the currently logged in user, and provides them with a QR Code that can be scanned by any 2 Factor Authentication app. 

Once the QR Code or Auth Secret has been inputed into the app, the user must then validate the token is set up correctly and working by using the supplied validation form. If the token supplied by the user validates, the auth secret will then be accociated with that users account and they will be required to use their authentication token upon each login going forward. 

#### Properties
GAuthx only has two available properties currently.


<table class="mdl-data-table mdl-js-data-table  mdl-shadow--2dp">
  <tr>
    <th class="mdl-data-table__cell--non-numeric">Name</th>
    <th class="mdl-data-table__cell--non-numeric">Type</th>
    <th class="mdl-data-table__cell--non-numeric">Default</th>
    <th class="mdl-data-table__cell--non-numeric">Description</th>
  </tr>
  <tr>
    <td class="mdl-data-table__cell--non-numeric">responseTpl</td>
    <td class="mdl-data-table__cell--non-numeric">Optional / String</td>
    <td class="mdl-data-table__cell--non-numeric">GAuthxResponse</td>
    <td class="mdl-data-table__cell--non-numeric"> Chunk name used to format the response message</td>
  </tr>
  <tr>
    <td class="mdl-data-table__cell--non-numeric">tpl</td>
    <td class="mdl-data-table__cell--non-numeric">Optional / String</td>
    <td class="mdl-data-table__cell--non-numeric">GAuthxTpl</td>
    <td class="mdl-data-table__cell--non-numeric">Chunk name used to format QR Code and Verification Form</td>
  </tr>
</table>

#### Usage

```
[[!GAuthx? &responseTpl=`GAuthxResponseTpl` &tpl=`GAuthxTpl`]] 
```



## GAuthxHook
 
This Snippet is to be useds as a PRE-Hook for  Shaun McCormick's snippet "Login" - it allows for you to add 2 factor authentication (using google authenticator) to your member only areas in any front-end context on your site.

#### Properties

GAuthx only has two available properties currently.
 
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
<thead>
  <tr>
    <th class="mdl-data-table__cell--non-numeric">Name</th>
    <th class="mdl-data-table__cell--non-numeric">Type</th>
    <th>Default</th>
    <th class="mdl-data-table__cell--non-numeric">Description</th>
  </tr>
 </thead>
 <tbody>
 
  <tr>
    <td class="mdl-data-table__cell--non-numeric">tolerance</td>
    <td class="mdl-data-table__cell--non-numeric">Optional / Integer</td>
    <td>2</td>
    <td class="mdl-data-table__cell--non-numeric">Sets the amount of time / tolerance you wish the authenticator to allow a provided token to be valid for.</td>
  </tr>
  <tr>
    <td class="mdl-data-table__cell--non-numeric">historyLimit</td>
    <td class="mdl-data-table__cell--non-numeric">Optional / Integer</td>
    <td>10</td>
    <td class="mdl-data-table__cell--non-numeric">Sets the number of provided tokens you wish to be remembered before a token could be used again.</td>
  </tr>
    <tr>
    <td class="mdl-data-table__cell--non-numeric">loginTpl</td>
    <td class="mdl-data-table__cell--non-numeric">Optional / String</td>
    <td class="mdl-data-table__cell--non-numeric">GAuthxLoginTpl</td>
    <td class="mdl-data-table__cell--non-numeric">Example Tpl for the Login snippet that includes the correct token input feild.</td>
  </tr>
  </tbody>
</table>
 

 
 
 
 
#### Usage
GAuthxHook is intended to be used as a PreHook for the [Login](https://github.com/splittingred/Login) snippet by [@Splittingred](https://github.com/splittingred). 

I have also included an example loginTpl that includes the token input.

```
[[!Login? 
    &loginTpl=`GAuthxLoginTpl` 
    &preHooks=`GAuthxHook` 
    &tolerance=`3` 
    &historyLimit=`5`
]]
```


#### Notes:

1. In order for GAuthxHook to be used you must have first logged into your context (front-end) and used the GAuthx snippet to generate an Auth Secret and set up your 2 factor authentication app.
2. Once you have set up your app and have validated your token you will then be required to use 2 factor auth everytime you login to the front end as long as the GAuthx prehook is included in your Login call.
3. GAuthxHook also prevents "replay" attacks by keeping a history of the previous tokens you have used and not allowing you to use them again. Using the &historyLimit paramater lets you decide how many tokens it remembers. 
4. Setting the historyLimit to 0 will disable it, this is not reccomended. 
5. 2Factor-Authentication is not an end all security solution, it should be combined with other efforts such as securing your pages with SSL.


#### Bugs & Feature Requests

Please log any bugs / features quests on [Github](https://github.com/nick2687/GAuthx/issues)

###### Credit
GAuthx uses the [Google Authenticator](https://github.com/PHPGangsta/GoogleAuthenticator) class by [PHPGangsta](https://github.com/PHPGangsta) for generating QR Codes and validating user tokens.



