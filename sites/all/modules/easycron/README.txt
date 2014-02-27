Description
-----------
This module provides a convenient way to run Drupal's cron.php. After
registering an account on easycron.com, you can get an API token. By entering
this token into the settings page of Easy Cron module in your Drupal site's
backend, you can manage a webcron at there, this webcron will call your cron.php
automatically according to the setting. The minimum interval of two calling
actions can be as low as 1 minute. You can enable the "Email Me" option to
receive email notices from easycron.com about the status of your cron.php
execution.  "Log Execution" option tells easycron.com to log the response of the
URL calling, so that you can check the log in easycron.com's account page and
make sure your cron.php is running good.

EasyCron was written by Deng Zi Kuan (zk_deng).
Maintained by Deng Zi Kuan.

Install
-------
1) Copy the easycron folder to the modules folder in your installation.

2) Enable the module using Administer -> Site building -> Modules
   (/admin/build/modules).

3) Configure settings of webcron. Visit Administer -> Site configuration ->
   Easy cron (admin/settings/easycron), enter the API token got from
   easycron.com, configure the webcron settings.
