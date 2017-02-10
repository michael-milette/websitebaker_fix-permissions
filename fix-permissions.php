<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>WebsiteBaker CMS Fix Permissions</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  </head>
  <body style="background:url(http://www.websitebaker2.org/templates/wborg/img/bg1.png) repeat-x;">
  <div style="margin:0 auto;color:#333; margin-top:15px; width:760px;">
  <div style="background:url(http://www.websitebaker2.org/templates/wborg/img/WB-logo.png) no-repeat top left;width:100%;height:72px;border-bottom:1px solid #efefef;padding-top:8px;"><h2 style="color:#efefef;margin:0;padding-right:70px;padding-top:28px;text-align:right;">WebsitBaker Fix Permissions</h2></div>
  <div class="content" style="background:white;width:730px;padding:0 15px 15px 15px;font-family:sans-serif;">
  <?php
  /* Filename: fix-permissions.php
   * Author: Michael Milette, www.TNGConsulting.ca
   * Date: September 11, 2010
   * Copyright 2010 TNG Consulting Inc. All rights reserved.
   * System Requirements: PHP 4.3+, Linux or Unix, WebsiteBaker 2.7 to 2.8.1
   * @home  http://www.websitebakers.com
   * @version	0.2
   * @initial date		2010-09-11
  */

  // First set of files
  $perms_dirs = '0755'; // Permission for Directories
  $perms_fils = '0644'; // Permission for Files
  $extrafiles = '';
  $filelist = explode(' ',rtrim('htaccess.txt index.php upgrade-script.php account admin framework include install search '.$extrafiles));

  // set $WB_only to true for WebsiteBaker files only. Set to false to apply to all files and directories.
  $WB_only = true;
  // Is PHP Server API running in CGI mode?
  $IsCGIsapi = (stripos(php_sapi_name(),'cgi')!== false);

  // Second set of files - only applies if $WB_only = false or not CGI mode.
  if (!$IsCGIsapi||!$WB_only) {
    $perms_dirs2 = '0777'; // Permission for Directories
    $perms_fils2 = '0666'; // Permission for Files
  } else {
    $perms_dirs2 = $perms_dirs; // Permission for Directories
    $perms_fils2 = $perms_fils; // Permission for Files
  }
  $extrafiles2 = '';
  $filelist2 = explode(' ',rtrim('config.php languages media modules pages temp templates '.$extrafiles2));

  ?>
  <div style="font-size:0.8em;text-align:center;padding:2px;border-bottom:1px solid grey;">v0.2 - Created by <a href="http://www.tngconsulting.ca/">TNG Consulting Inc.</a> - Don't get frustrated trying to get your website setup&hellip; Just give us a call!</div>

<?php
// Apply changes to permissions
if (isset($_GET['confirmed'])) {
  echo '<p style="color:blue;">Resetting Permissions. This may take a while&hellip; only changes will be displayed.<br>';
  if (stripos(PHP_OS,'WIN') !== false) {
    echo '<p style="color:blue;font-weight:bold;text-align:center;">This script has no effect in PHP for Windows.</p>';
  }
  // DO IT!
  if ($WB_only) {
    echo '<H2>Processing&hellip;</h2>';
    if (file_exists('config.php') && file_exists('account') && file_exists('framework') && file_exists('modules') && file_exists('templates')) {
      foreach($filelist as $filename)
        fix_permissions($filename,$perms_dirs, $perms_fils);

      foreach($filelist2 as $filename)
        fix_permissions($filename,$perms_dirs2, $perms_fils2);
    } else {
      echo '<font color="red">You must place this file into the home directory of your WebsiteBaker installation.</font>';
    }
  } else {
    echo '<H1>Resetting Permissions for <b>'.dirname(__FILE__).'</b></h1>';
    fix_permissions(dirname(__FILE__), $perms_dirs, $perms_fils);
  }
  echo '<H2>Finished.</H2>';
  echo '<b>Click <a name="bottom" href="'.basename(__FILE__).'"><font color="GREEN">BACK</font></a> to go return to the information page.</b>';
} elseif (isset($_GET['preview'])) {
  // Only display permissions that need to be changed.
  echo '<p style="color:blue;">Viewing Permissions. This may take a while&hellip; only changes will be displayed.<br>';
  if (stripos(PHP_OS,'WIN') !== false) {
    echo '<p style="color:blue;font-weight:bold;text-align:center;">This script has no effect in PHP for Windows.</p>';
  }
  // DO IT!
  if ($WB_only) {
    echo '<H2>Processing&hellip;</h2>';
    if (file_exists('config.php') && file_exists('account') && file_exists('framework') && file_exists('modules') && file_exists('templates')) {
      foreach($filelist as $filename)
        view_permissions($filename,$perms_dirs, $perms_fils);

      foreach($filelist2 as $filename)
        view_permissions($filename,$perms_dirs2, $perms_fils2);
    } else {
      echo '<font color="red">You must place this file into the home directory of your WebsiteBaker installation.</font>';
    }
  } else {
    echo '<H1>Viewing Permissions for <b>'.dirname(__FILE__).'</b></h1>';
    view_permissions(dirname(__FILE__), $perms_dirs, $perms_fils);
  }
  echo '<H2>Finished.</H2>';
  echo '<b>Click <a href="'.basename(__FILE__).'?confirmed#bottom" onclick="return confirm(\'Are you sure you want to reset the permissions?\')"><font color="red">APPLY</font></a> to begin resetting permissions<br /> or <a name="bottom" href="'.basename(__FILE__).'"><font color="green">BACK</font></a> to go back to the information page.</b>';
} else {
  // Only Display Information
  ?>
  <p>This script will resets the permission for files and directories in WebsiteBaker. PHP is an interpreter script language. PHP scripts should <b>NEVER</b> need to be executable.</p>
  <div style="background:red;color:white;text-align:center;padding:10px;font-weight:bold;borders:1px solid black;">
  <p style="color:yellow;">IMPORTANT * WARNING * IMPORTANT * WARNING * IMPORTANT * WARNING * IMPORTANT</p>
  <p>------ Be aware that there is NO UNDO option for this tool ------</p>
  <p>If something goes wrong, you could loose access to your files.</p>
  <p>===>  USE   AT   YOUR   OWN   RISK  <===</p>
  <p style="color:yellow;">IMPORTANT * WARNING * IMPORTANT * WARNING * IMPORTANT * WARNING * IMPORTANT</p>
  </div><br />
  <table borders="0"><tr>
  <td valign="top" width="50%">
    <p>This script applies permissions to the following file and directories including those inside the directories.</p>
    <p>The standard WB directory list for v2.7 to 2.8.1 includes:</p>
    <ul>
    <li>htaccess.txt</li>
    <li>index.php</li>
    <li>upgrade-script.php</li>
    <li>account</li>
    <li>admin</li>
    <li>framework</li>
    <li>include</li>
    <li>install</li>
    <li>search</li>
    <li>config.php</li>
    <li>languages</li>
    <li>media</li>
    <li>modules</li>
    <li>pages</li>
    <li>temp</li>
    <li>templates</li>
    </ul>
  </td><td valign="top">
  <p><b>Instructions:</b> Copy this file into the home directory of your website and access it using a web browser. Example: www.yoursite.com/<?php echo basename(__FILE__); ?>
  <p><b>Options</b></p>
  <ul>
    <li>You may set <b>$WB_only</b> to false if you want it to affect all files and directories.</li>
    <li>You may specify two sets of permissions for separate list of files and directories.</li>
    <li>You may specify two additional sets of files and directories using the <b>$extrafiles</b> variable.</li>
  </ul>
  <?php
  if (stripos(PHP_OS,'WIN') !== false) {
    echo '<p style="color:blue;">This script has no effect in PHP for Windows.</p>';
  }

  echo '<p><b>Note:</b> Your PHP Server API is '.strtoupper(php_sapi_name()).' ';
  echo ($IsCGIsapi?'(excellent!)':'(CGI would be better)');
  ?>
  <p><br /> <br /> <b>Click <a href="<?php echo basename(__FILE__); ?>?confirmed#bottom" onclick="return confirm('Are you sure you want to reset the permissions?')"><font color="red">APPLY</font></a> to begin resetting permissions<br /> or <a href="<?php echo basename(__FILE__); ?>?preview#bottom"><font color="green">PREVIEW</font></a> to just preview permission changes without actually making any changes.</b></p>
  </td></tr></table>
  <?php
}

// Sets permissions for both files and directories.
function view_permissions($dir, $perms_dirs, $perms_fils) {
  if (is_dir($dir)) {
    if (substr(decoct(fileperms($dir)),-4) != $perms_dirs) {
      echo "<p>Directory: $dir (is ".substr(decoct(fileperms($dir)),-4).") - ";
      echo "<font color='red'>Not changed (should be $perms_dirs)</font></p>";
    }

    if ($handle = opendir($dir)) {
      while (($file = readdir($handle)) !== false) {
        if($file != '.' && $file != '..') {
          $fullpath = "$dir/$file";
          if (is_link($fullpath)) {
            // Link... Skip it.
          } elseif (is_dir($fullpath)) {
            // Directory... Recurse into it.
            view_permissions($fullpath, $perms_dirs, $perms_fils);
          } elseif (substr(decoct(fileperms($fullpath)),1) != $perms_fils) {
            // File with wrong permissions. Change them.
            echo "<p>File: $fullpath (is ".substr(decoct(fileperms($fullpath)),-4).") - ";
            echo "<font color='red'>Not changed (should be $perms_fils)</font></p>";
          }
        }
      }
      closedir($handle);
    }
  }
}

// Sets permissions for both files and directories.
function fix_permissions($dir, $perms_dirs, $perms_fils) {
  // just in case we got a newbie at the keyboard setting things up.
  if(strlen($perms_dirs)!=4||strlen($perms_fils)!=4) {
   echo 'Incorrect settings for permissions. Aborting! '.strlen($perms_dirs);
   return;
  }

  if (is_dir($dir)) {
    // Try to set the permissions for each directory to $perms_dirs.
    if (substr(decoct(fileperms($dir)),-4) != $perms_dirs) {
      echo "<p>Directory: $dir (was ".substr(decoct(fileperms($dir)),-4).") - ";
      if (chmod($dir, octdec($perms_dirs)))
        echo "<font color='green'>Fixed (now $perms_dirs)</font></p>";
      else
        echo "<font color='red'>Failed, could not be changed!</font></p>";
    }

    if ($handle = opendir($dir)) {
      while (($file = readdir($handle)) !== false) {
        if($file != '.' && $file != '..') {
          $fullpath = "$dir/$file";
          if (is_link($fullpath)) {
            // Link... Skip it.
          } elseif (is_dir($fullpath)) {
            // Directory... Recurse into it.
            fix_permissions($fullpath, $perms_dirs, $perms_fils);
          } elseif (substr(decoct(fileperms($fullpath)),1) != $perms_fils) {
            // File with wrong permissions. Change them.
            echo "<p>File: $fullpath (was ".substr(decoct(fileperms($fullpath)),-4).") - ";
            // Set permissions to $perms_fils.
            if (chmod($fullpath, octdec($perms_fils)))
              echo "<font color='green'>Fixed (now $perms_fils)</font></p>";
            else
              echo "<font color='red'>Failed, could not be changed!</font></p>";
          }
        }
      }
      closedir($handle);
    }
  }
}
?>
</div>
</div>
</div>
  </body>
</html>