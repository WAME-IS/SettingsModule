<?php 

namespace Wame\SettingsModule\Components;

use Wame\Utils\HttpRequest;
use Wame\AdminModule\Components\BaseControl;
use Wame\SettingsModule\Models\SettingsManager;


interface ISettingsMenuControlFactory
{
	/** @return SettingsMenuControl */
	public function create();	
}


class SettingsMenuControl extends BaseControl
{
	/** @var SettingsManager */
	private $settingsManager;
	
	/** @var integer */
	private $id;
	
	
	public function __construct(
		HttpRequest $httpRequest,
		SettingsManager $settingsManager
	) {
		parent::__construct();
		
		$this->settingsManager = $settingsManager->getTypes();

		$this->id = $httpRequest->getParameter('id');
	}
	
	
	public function render()
	{
		$this->template->types = $this->settingsManager;

		$this->componentRender();
	}

}