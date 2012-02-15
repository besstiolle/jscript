<?php
if (!isset($gCms)) exit;

$this->RemovePermission('cms_script_use');

// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));
?>