<?php
if (!isset($gCms)) exit;


$smarty->assign_by_ref('module',$this);
echo $this->ProcessTemplate('default.tpl');

?>