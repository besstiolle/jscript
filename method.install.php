<?php
if (!isset($gCms)) exit;

// create a permission
$this->CreatePermission('JScript_use','{JScript} : Set Prefs');

// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('installed', $this->GetVersion()));
?>