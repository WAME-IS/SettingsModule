<?php 

namespace Wame\SettingsModule\Registers;

use Wame\SettingsModule\Registers\Types\SettingsGroup;

class SettingsGroupRegister extends \Wame\Core\Registers\PriorityRegister
{
    public function __construct()
    {
        parent::__construct(SettingsGroup::class);
    }

    /**
     * Get items
     * 
     * @return array
     */
    public function getTypes()
    {
        $types = $this->removeTypes();

        return \Wame\Utils\Arrays::sortByPriority($types);
    }
    
    public function add($service, $name = null, $parameters = [])
    {
        $service->setAlias($name);
        parent::add($service, $name, $parameters);
    }
    
}