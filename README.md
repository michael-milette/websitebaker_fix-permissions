Fix Permissions for WebsiteBaker
================================

Copyright
---------
Copyright © 2015-2017 TNG Consulting Inc. - http://www.tngconsulting.ca/

This file is part of Fix Permissions for WebsiteBaker - http://websitebaker.org

Fix Permissions is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

Fix Permissions is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Fix Permissions.  If not, see <http://www.gnu.org/licenses/>.

Authors
-------
Michael Milette - Lead Developer
Acknowledgement and gratitude to erpe for his design of the common look and feel for third party applications which he developed in his WebsiteBaker Precheck (check-wb) project.

Description
-----------
Fix Permissions is a standalone script (not a WebsiteBaker module) which, when placed and accessed in your home directory for your website, will reset the permissions for all WebsiteBaker related directories to the correct settings. See the following link for details on what these permissions should be.

http://www.websitebaker.org/forum/index.php/topic,18526.msg123505.html#msg123505

Note: Incorrectly setting permissions can be the hidden cause behind many issues with your website, from not being able to create or modify a new page to being unable to upload files, modules, templates and languages.

Requirements
------------
This tool requires WebsiteBaker 2.7 to 2.8.3 from http://websitebaker.org

This tool is only compatible with Linux based web servers. It will not have any effect on Windows based web servers.

Changes
-------
The first public ALPHA version was released on 2010-09-13.

For more information on releases since then, see CHANGELOG.md.

Installation and Update
-----------------------
Download the latest version of this tool from:
https://github.com/michael-milette/websitebaker_fix-permissions

Use FTP to upload just the PHP file to the home directory of your website. Additional information will be displayed when you first access the script through your browser.

To update, just replace the existing version with a new version.

Be sure to delete the file from your website after you have finished using it.

Uninstallation
--------------
To uninstall the file, simply delete it from your website.

Configuration and Usage
-----------------------

Fix Permissions will work as is. However, should you want to configure it for a specific purpose, there are some settings you can change.

Using a text editor to edit the PHP file itself, you can configure three things:

* The list of files
* The permissions
* Whether you want to apply the settings only to WebsiteBaker files or all files.

The settings are located near the top of the file.

Always be sure to test the PHP script out on a non-production system before you decide to trust it with your production site.

IMPORTANT: There is NO UNDO feature.

It is generally a good idea to have a working backup of your site before you run this script. Note that it does not touch the database in any way.

To run the script, simply access the file using your web browser. For example, www.yoursite.com/fix_permissions.php

You will be presented with two options:

* Apply the changes
* Preview the changes

The Preview screen will also give you the option to Apply the changes.

Security considerations
-----------------------
This tool modifies permissions on your webserver. It is your responsibility to evaluate whether the new permission settings provide appropriate security for your particular website.

IMPORTANT: Be sure to remove this file from your server when you are done.

Motivation for this tool
------------------------
The development of this tool was motivated through our own experience in WebsiteBaker development and comments in the WebsiteBaker support forums. It is supported by TNG Consulting Inc.

Limitations
-----------
Although it will run, this script will not affect Windows based web servers.

Future Releases
---------------
There are no plans for future releases at the moment. If you have a requirement, please contact us at www.tngconsulting.ca

Further Information and Support
-------------------------------
For further information regarding the Fix Permissions for WebsiteBaker tool, support or to
report a bug, please visit the project page at:

http://github.com/michael-milette/websitebaker_fix-permissions

Paid support is available from www.tngconsulting.ca

You may also be able to find free support by going to the public forums on WebsiteBaker.org:
http://forum.websitebaker.org/index.php/topic,19268.msg129174.html#msg129174

Language Support
----------------
This tool only includes support for the English language.

If you need a different language, please feel free to contribute translations by preparing a pull request and submitting it to the project page at:

http://github.com/michael-milette/websitebaker_fix-permissions

Troubleshooting
---------------
Although a fair amount of testing has been done on both Linux and Windows, just because the script worked for us doesn't mean it will work for you.

The requirements are:

* An installed version of WebsiteBaker 2.7 to 2.8.3
* Being comfortable editing PHP source code (if you want to customize it).

Should something go wrong with the script, you could loose access to your files on the server. Should this happen, a good strategy is to attempt to reset the permissions using the web-based file manager provided to you by your hosting provider. It can often be found, for example, in your cPanel or similar application. This application may have additional rights that you don't have when accessing the files through FTP or even a PHP script. The only alternative may be to to contact your hosting provider for assistance.

Other than that, it's simple and pretty straight forward. Be sure to also check out the Check-WB tool at:
http://www.websitebakers.com/pages/tools/check-wb.php
