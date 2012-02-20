<?php
if (!isset($gCms)) exit;

$this->RemovePermission('JScript_use');

//Suppression des handlers d'evenements
$this->RemoveEventHandler('core','ContentPostRender');

// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));
?>