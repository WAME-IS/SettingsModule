<?php

namespace Wame\SettingsModule\Models;

use Nette\InvalidArgumentException;
use Nette\Object;
use Nette\Utils\ArrayHash;
use Wame\SettingsModule\Repositories\SettingsRepository;

class SettingsManager extends Object
{

    /** @var SettingsRepository */
    private $settingsRepository;

    /** @var SettingsGroupManager */
    private $settingsGroupManager;

    /** @var ArrayHash[] */
    private $cache;

    public function __construct(SettingsRepository $settingsRepository, SettingsGroupManager $settingsGroupManager)
    {
        $this->settingsRepository = $settingsRepository;
        $this->settingsGroupManager = $settingsGroupManager;
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

            if (!in_array($name, $this->settingsGroupManager->getAll())) {
                throw new InvalidArgumentException("Settings type isn't declared.");
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
        return $this->getTypeSettings($name);
    }
}
