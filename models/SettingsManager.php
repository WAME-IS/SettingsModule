<?php 

namespace Wame\SettingsModule\Models;

use Wame\Utils\Strings;

class SettingsManager
{
	const DEFAULT_TYPE = 'General';
	
    /** @var array */
    public $types = [];

    /** @var array */
    private $removeTypes = [];
    
    
    /**
     * Add type
     * 
     * @param object $service
     * @param string $name
     * @param int $priority
	 * @return \Wame\SettingsModule\Components\SettingsManager
	 */
    public function addType($service, $name = null, $priority = 0)
    {
        if (!$name) {
            $name = Strings::getClassName($service);
        }

        $this->types[$name] = [
            'name' => $name,
            'priority' => $priority,
            'service' => $service
        ];

        return $this;
    }


    /**
     * Remove type
     * 
     * @param mixed $name
	 * @return \Wame\SettingsModule\Components\SettingsManager
	 */
    public function removeType($name)
    {
        if (is_object($name)) {
            $name = Strings::getClassName($name);
        }

        $this->removeItems[$name] = $name;

        return $this;
    }


    /**
     * Remove types
     * 
     * @return array
     */
    private function removeTypes()
    {
        $types = $this->types;

        foreach ($this->removeTypes as $type) {
            if (array_key_exists($type, $types)) {
                unset($types[$type]);
            }
        }

        return $types;
    }


    /**
     * Get items
     * 
     * @return array
     */
    public function getTypes()
    {
        $types = $this->removeTypes();

        return $this->sortTypes($types);
    }


    /**
     * Sort types
     * 
     * @param array $types
     * @return array
     */
    private function sortTypes($types)
    {
        $return = [];

        foreach ($types as $type) {
            $return[$type['priority']][$type['name']] = $type['service']; 
        }

        // Sort by priority
        krsort($return);

        return $return;
    }

	
//    /**
//     * Add form containers from type
//     * 
//     * @param SettingsForm $settingsForm
//     * @return SettingsForm
//     */
//    public function addFormContainers($settingsForm)
//    {
//		$type = $settingsForm->id;
//
//		if (isset($this->types[$type]) && method_exists($this->types[$type]['service'], 'addFormContainers')) {
//			$settingsForm->addFormContainers($this->types[$type]['service']->getFormContainers());
//		}
//
//        return $settingsForm;
//    }

}