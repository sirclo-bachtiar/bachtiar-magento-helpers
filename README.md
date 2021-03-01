## Bachtiar Service Helper

> #### Service Helper.
> This service is used to help some activities during your work, which contains several functions that may make your job simpler.
```bash
composer require sirclo-bachtiar/bachtiar-zend-magento2-helper
```
> - #### Logger Service
> it's using for saving log activity, after install this library, you need to modify [ directory_target ], the location is -> [ vendor/sirclo-bachtiar/bachtiar-zend-magento2-helper/src/library-zend-logger/Service/LogService.php , Ln: 71 Col: 30 ], change the [ directory_target ] to your directory where you should saving your log [ ex: var/log/ ].
> - #### Response Service
> it's using for create a response result from your functions/methods activity.

