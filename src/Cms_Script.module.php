<?php

class Cms_Script extends CmsModule
{
  function GetName()
  {
    return get_class($this);
  }
  
  function GetFriendlyName()
  {
    return $this->Lang('friendlyname');
  }

  function GetVersion()
  {
    return '0.0.1';
  }
  
  function GetHelp()
  {
    return $this->Lang('help');
  }
  
  function GetAuthor()
  {
    return 'Kevin Danezis (Bess)';
  }

  function GetAuthorEmail()
  {
    return 'contact@furie.be';
  }
  
  function GetChangeLog()
  {
    return $this->Lang('changelog');
  }
  
  function IsPluginModule()
  {
    return true;
  }

  function HasAdmin()
  {
    return true;
  }

  function GetAdminSection()
  {
    return 'extensions';
  }

  function GetAdminDescription()
  {
    return $this->Lang('moddescription');
  }

  function VisibleToAdminUser()
  {
    return $this->CheckPermission('cms_script_use');
  }
  
  function GetDependencies()
  {
    return array();
  }

  function MinimumCMSVersion()
  {
    return "1.10.0";
  }
  
  function SetParameters()
  {
    //utilisation en {cms_script}
	$this->RegisterModulePlugin();
	
	//Securite
	$this->RestrictUnknownParams();
	
	/*$this->CreateParameter('action', null, 'todo');
	$this->SetParameterType('action',CLEAN_STRING);
	
	$this->CreateParameter('template', null, 'todo');
	$this->SetParameterType('template',CLEAN_STRING);
	
	$this->CreateParameter('categorie', null, 'todo');
	$this->SetParameterType('categorie',CLEAN_INT);
	
	$this->CreateParameter('texte', null, 'todo');
	$this->SetParameterType('texte',CLEAN_STRING);
	
	$this->CreateParameter('url', null, 'todo');
	$this->SetParameterType('url',CLEAN_STRING);
	
	$this->CreateParameter('msgNOk', null, 'todo');
	$this->SetParameterType('msgNOk',CLEAN_STRING);
	
	$this->CreateParameter('msgOk', null, 'todo');
	$this->SetParameterType('msgOk',CLEAN_STRING);
	
	//depotoire pour le re-routage
	$this->CreateParameter('none', null, 'todo');
	$this->SetParameterType('none',CLEAN_STRING);
	$this->CreateParameter('none2', null, 'todo');
	$this->SetParameterType('none2',CLEAN_STRING);
	*/
	
  }
 
  
  function InstallPostMessage()
  {
    return $this->Lang('postinstall',$this->GetVersion());
  }

  function UninstallPostMessage()
  {
    return $this->Lang('postuninstall');
  }
  
  function UninstallPreMessage()
  {
    return $this->Lang('really_uninstall');
  }
}
?>