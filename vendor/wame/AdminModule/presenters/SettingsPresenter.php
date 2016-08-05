<?php

namespace App\AdminModule\Presenters;

use Wame\SettingsModule\Repositories\SettingsRepository;
use Wame\SettingsModule\Models\SettingsManager;
use Wame\SettingsModule\Components\SettingsMenuControl;
use Wame\SettingsModule\Components\ISettingsMenuControlFactory;
use Wame\SettingsModule\Registers\SettingsGroupRegister;


class SettingsPresenter extends BasePresenter
{
	/** @var SettingsRepository @inject */
	public $settingsRepository;
	
	/** @var SettingsManager @inject */
	public $settingsManager;
    
    /** @var SettingsGroupRegister @inject */
    public $settingsGroupRegister;
	
	/** @var ISettingsMenuControlFactory @inject */
	public $ISettingsMenuControlFactory;
	
	/** @var array */
	public $settingsEntity;
	
	/** @var mixed */
	public $settingsType;
	
	/** @var array */
	private $componentList = [];
	
	/** @var array */
	private $components = [];


	public function actionDefault()
	{
		if (!$this->user->isAllowed('admin.settings', 'view')) {
			$this->flashMessage(_('To enter this section you do not have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:', ['id' => null]);
		}
		
		if (!$this->id) {
			$this->id = SettingsManager::DEFAULT_TYPE;
		}

		if (!$this->settingsGroupRegister->getByName($this->id)) {
			$this->flashMessage(_('This section does not exist in SettingsManager.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => null]);			
		}
		
		$this->setType();
	}

	/**
	 * Settings menu control
	 * 
	 * @return SettingsMenuControl
	 */
	protected function createComponentSettingsMenu()
	{
		$control = $this->ISettingsMenuControlFactory->create();
		
		return $control;
	}

	
	/**
	 * Set type and add components
	 */
	private function setType()
	{
		$this->settingsType = $this->settingsGroupRegister->getByName($this->id);
		$this->settingsEntity = $this->settingsRepository->getList(['type' => $this->id], 'name');

		if (method_exists($this->settingsType, 'getServices')) {
			$this->components = $this->settingsType->getServices();
			$this->addComponents($this->components);
		}
	}
	
	
	/**
	 * Register components
     * 
     * @return \Wame\ListControlModule\ListControl
     */
	private function addComponents($components)
	{
		foreach ($components as $priority) {
			foreach ($priority as $name => $service) {
				$this->addComponent($service, $name);
				$this->componentList[] = $name;
			}
		}

		return $this;
	}
	

	public function renderDefault()
	{
		$this->template->siteTitle = $this->settingsType->getTitle();
		$this->template->components = $this->components;
	}
	
}
