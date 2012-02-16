<?php
if (!isset($gCms)) exit;

// Verification de la permission
if (!$this->VisibleToAdminUser()) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

$smarty->assign_by_ref('module',$this);
echo $this->ProcessTemplate('defaultadmin.tpl');
?>