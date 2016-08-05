<?php 

namespace Wame\SettingsModule\Models;

class SettingsGroupManager extends \Wame\Core\Registers\PriorityRegister
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
}