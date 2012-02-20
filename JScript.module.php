<?php

class JScript extends CmsModule
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
    return $this->CheckPermission('JScript_use');
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
    //can nopw be used liike {JScript [...]}
	$this->RegisterModulePlugin();
	
	//Security
	$this->RestrictUnknownParams();
	
  //All parameters : https://github.com/besstiolle/jscript/wiki/Appel-du-module-et-param%C3%A8tres-possibles
	$this->CreateParameter('file', null, $this->Lang('param_file'));
	$this->SetParameterType('file',CLEAN_STRING);

	$this->CreateParameter('url', null, $this->Lang('param_url'));
	$this->SetParameterType('url',CLEAN_STRING);
	
	//$this->CreateParameter('gc', null, $this->Lang('param_gc'));
	//$this->SetParameterType('gc',CLEAN_STRING);
	
	$this->CreateParameter('smarty', null, $this->Lang('param_smarty'));
	$this->SetParameterType('smarty',CLEAN_STRING);
 
	$this->CreateParameter('stack', null, $this->Lang('param_stack'));
	$this->SetParameterType('stack',CLEAN_STRING);
	
	$this->CreateParameter('load', null, $this->Lang('param_load'));
	$this->SetParameterType('load',CLEAN_STRING);
	
	$this->CreateParameter('compress', null, $this->Lang('param_compress'));
	$this->SetParameterType('compress',CLEAN_STRING);
	
	$this->CreateParameter('append', null, $this->Lang('param_append'));
	$this->SetParameterType('append',CLEAN_STRING);

	$this->CreateParameter('priority', null, $this->Lang('param_priority'));
	$this->SetParameterType('priority',CLEAN_INT);
  
  $this->CreateParameter('debug', null, $this->Lang('param_debug'));
  $this->SetParameterType('debug',CLEAN_STRING);
	
	
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

  /**
   * A vrai specifie que la classe possede un appel a evenement
   */
  function HandlesEvents()
  {
    return true;
  }

  function DoEvent($originator, $eventname, &$params)
  {
        
    if($eventname == "ContentPostRender" )
    {
      Generate::displayScripts($params);
    }
    
  }

}
?>