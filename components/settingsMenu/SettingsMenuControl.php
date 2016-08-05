<?php 

namespace Wame\SettingsModule\Components;

use Nette\DI\Container;
use Wame\Utils\HttpRequest;
use Wame\AdminModule\Components\BaseControl;
use Wame\SettingsModule\Registers\SettingsGroupRegister;


interface ISettingsMenuControlFactory
{
	/** @return SettingsMenuControl */
	public function create();	
}


class SettingsMenuControl extends BaseControl
{
	/** @var SettingsGroupRegister */
	private $settingsGroupRegister;
	
	/** @var integer */
	private $id;
	
	
	public function __construct(
        Container $container,
		HttpRequest $httpRequest,
		SettingsGroupRegister $settingsGroupRegister
	) {
		parent::__construct($container);
		
		$this->settingsGroupRegister = $settingsGroupRegister;

		$this->id = $httpRequest->getParameter('id');
	}
	
	
	public function render()
	{
		$this->template->types = $this->settingsGroupRegister->getAll();
	}

}