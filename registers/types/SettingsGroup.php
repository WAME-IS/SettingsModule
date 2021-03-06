<?php

namespace Wame\SettingsModule\Registers\Types;

use Wame\Core\Forms\FormFactory;
use Wame\Utils\Arrays;
use Wame\Utils\Strings;
use Wame\Core\Registers\Types\IRegisterType;


abstract class SettingsGroup extends FormFactory implements IRegisterType
{	
	/** @var array */
	public $services = [];

    /** @var array */
    private $removeServices = [];
    
    /** @var string */
    private $alias;
	
	
	/**
	 * Get settings type title
	 */
	abstract public function getTitle();
    
    
    /**
     * Set alias
     * 
     * @param string $alias alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }
    
    /**
     * Return alias
     * 
     * @return string   alias
     */
    public function getAlias()
    {
        return $this->alias;
    }
    
	
	/**
	 * Get components (forms, controls...)
	 */
	abstract public function getComponentServices();

    
    /**
     * Add component
     * 
     * @param object $service
     * @param string $name
     * @param int $priority
	 * @return \Wame\SettingsModule\Models\SettingsType
	 */
    public function addService($service, $name = null, $priority = 0)
    {
        if (!$name) {
            $name = Strings::getClassName($service);
        }

        $this->services[$name] = [
            'name' => $name,
            'priority' => $priority,
            'service' => $service
        ];

        return $this;
    }


    /**
     * Remove component
     * 
     * @param mixed $name
	 * @return \Wame\SettingsModule\Models\SettingsType
	 */
    public function removeService($name)
    {
        if (is_object($name)) {
            $name = Strings::getClassName($name);
        }

        $this->removeServices[$name] = $name;

        return $this;
    }


    /**
     * Remove components
     * 
     * @return array
     */
    private function removeServices()
    {
        $services = $this->services;

        foreach ($this->removeServices as $service) {
            if (array_key_exists($service, $services)) {
                unset($services[$service]);
            }
        }

        return $services;
    }


    /**
     * Get items
     * 
     * @return array
     */
    public function getServices()
    {
		$this->getComponentServices();
		
        $services = $this->removeServices();

        return Arrays::sortByPriority($services);
    }
	
	
    /**
     * Add form containers from type
     * 
     * @param SettingsForm $settingsForm
     * @return SettingsForm
     */
    public function addFormContainers($settingsForm)
    {
		if (count($this->getFormContainers()) > 0) {
			$settingsForm->addFormContainers($this->getFormContainers());
		}

        return $settingsForm;
    }

}
