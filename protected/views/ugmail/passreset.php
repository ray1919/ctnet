<?php
/**
 * available variables inside the $data array:
 * '{email}'=> user email address,
 * '{username}'=> username,
 * '{activation_code}'=> activation code if available,
 * '{link}'=> short link without get parameters,
 * '{full_link}'=> full link with get parameters,
 * '{website}'=> value of the appName parameter inside your configuration file
 * '{temporary_username}' => boolean: true if the username is temporary and can be changed
 *
 * usage example:
 * $data['{link}']
 */
?>
You requested a password reset.<br/>
Your account will be disabled until you set a new password.<br/>
To reactivate your account and set the new password please click on this link:<br/>
<a href="<?php echo $data['{full_link}']; ?>"><?php echo $data['{full_link}']; ?></a>
<br/>
or you can go to this address<br/>
<a href="<?php echo $data['{link}']; ?>"><?php echo $data['{link}']; ?></a>
<br/>
and insert in the form the following data<br/>
username: <b><?php echo $data['{username}']; ?></b><br/>
activation code: <b><?php echo $data['{activation_code}']; ?></b>