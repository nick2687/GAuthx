# GAuthx - Modx Extra

* Author: Nick Clark, (@nick2687)
* Licensed under the GNU License.
* Credit: Thanks go to Michael Kliewe, (@PHPGangsta) who wrote the GoogleAuthenticator class this Modx Extra uses.
* Dependancies: Login - https://github.com/splittingred/Login

Description
------

This Modx Extra enables use of the Google Authenticator mobile app for 2-factor-authentication in conjunction with  Shaun McCormick's Login Snippet (https://github.com/splittingred/Login). This Extra contains two snippets, one to generate secrets and present a QR-Code for scanning the secret. The other is used as a Login PreHook to validate codes when a user attempts to login.

The system also includes a class for preventing replay-attack's by making sure that previously used codes cannot be reused. 

Installing GAuthx
------

Go to System | Package Management on the main menu in the MODX Manager and click on the &quot;Download Extras&quot; button. That will take you to the Revolution Repository (AKA Web Transport Facility). Put GAuthx in the search box and press Enter. Click on the &quot;Download&quot; button, and once the package is downloaded, click on the &quot;Back to Package Manager&quot; button. That should bring you back to your Package Management grid. Click on the &quot;Install&quot; button next to GAuthx in the grid. The GAuthx package should now be installed.

Usage:
------


GAuthx Properties
------
