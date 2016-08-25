<?php

namespace Wame\SettingsModule\Models;

use Nette\InvalidArgumentException;
use Nette\Object;
use Nette\Utils\ArrayHash;
use Wame\SettingsModule\Repositories\SettingsRepository;
use Wame\SettingsModule\Registers\SettingsGroupRegister;

class SettingsManager extends Object
{
    const DEFAULT_TYPE = 'General';

    /** @var SettingsRepository */
    private $settingsRepository;

    /** @var SettingsGroupRegister */
    private $settingsGroupRegister;

    /** @var array */
    private $cache = [];

    public function __construct(SettingsRepository $settingsRepository, SettingsGroupRegister $settingsGroupRegister)
    {
        $this->settingsRepository = $settingsRepository;
        $this->settingsGroupRegister = $settingsGroupRegister;
    }

    /**
     * Get group of settings.
     * 
     * For example $settingsManager->general->customTemplate will return
     * setting named "customTemplate" in group "general".
     * 
     * @param string $name
     * @return ArrayHash All settings in group
     * @throws InvalidArgumentException
     */
    public function getTypeSettings($name)
    {
        if (!array_key_exists($name, $this->cache)) {

            if (!$this->settingsGroupRegister->getByName($name)) {
                throw new InvalidArgumentException("Settings type [$name] isn't declared.");
            }

            $settings = [];
            foreach ($this->settingsRepository->find(['type' => $name]) as $entity) {
                $settings[$entity->name] = $entity->value;
            }
            $this->cache[$name] = ArrayHash::from($settings);
        }
        return $this->cache[$name];
    }

    /**
     * Get group of settings.
     * 
     * @param string $name Name of type
     */
    public function &__get($name)
    {
        $a = $this->getTypeSettings($name);
        return $a;
    }
}
