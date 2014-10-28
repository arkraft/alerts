alerts
======

Laravel 4 Alerts provider to add bootstrap alerts from controllers using the great  [bootstrap-growl](https://github.com/ifightcrime/bootstrap-growl) jquery plugin by Nick Larson.

Installation
-------------
Install with composer
```bash
composer require arkraft/alerts 0.8.0
```
Register the service provicer in `app/config/app.php` in the providers array
```php
'Arkraft\Alerts\AlertsServiceProvider'
```
Add an alias under the alias array in `app/config/app.php`
```php
'Alerts' => 'Arkraft\Alerts\Alerts',
```
And the last step ist to publish the assets. Execute the following command in the root of your project
```
php artisan asset:publish --path="vendor/arkraft/alerts/src/public/" jquery
```
This will add the `jquery.bootstrap-growl.min.js` to your `public/packages/jquery` directory.
Usage
---------------
Now you can add alerts from your controller. The following message types are possible
* Alerts::addInfo
* Alerts::addSuccess
* Alerts::addWarning
* Alerts::addDanger

All methods have the same parameters:
* message: the message you want to print
* title (optional): the title of the message (will be prepended in strong letters to the message)
* configuration (optional): additional configuration array
For Example:
```
Alerts::addInfo("This is a simple info message", "Info");
```
will an the following message
![example info message](http://s14.directupload.net/images/141027/s7g5ufrf.png)

### Displaying the alerts
Add 
```
{{ Alerts::getAlerts() }}
```
to your sites javascripts.

Configuration
------------------
You can export the default configuration with
```
php artisan config:publish arkraft/alerts
```
This will export the following array to 'config/packages/arkraft/alerts/config.php'
```
return array(
    'offset' => '{from: "top", amount: 40}',
    'align' => 'right',
    'width' => 250,
    'delay' => 4000,
    'allowDismiss' => false,
    'stackupSpacing' => 5
);
```
The configuration values:
+ offset: array with offset values, the alerts will apear 40px from top
+ align: possible values are right, center and left. 
+ width: the width of the message box
+ delay: delay for the message to disappear, this message will stay for 4 seconds before it disappears
+ allowDismiss: true will print a close button on the right side of the alert box
+ stackupSpacing: spacing between multiple alert boxes

The changes on this configuration file are global for all boxe. To change the configuration for a single alert you can use the configuration parameter like this
```
Alerts::addDanger("This is a simple error message", "Error", array("delay" => 0, "allowDismiss" => true, "align" => "center"));
```
This will show a message wich will stay in the center of the screen until it is closed with the close button on the right.
Configurations passed as a parameter will overwrite the default configuration.
