<?php

namespace Wame\SettingsModule\Vendor\Wame\AdminModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;

abstract class SettingsContainer extends BaseContainer
{
    /** {@inheritdoc} */
    public function configure()
    {
        $this->addText($this->getSettingsName(), $this->getSettingsTitle());
    }

    /** {@inheritDoc} */
    public function setDefaultValues($entity = null)
    {
        $entity = $this->getParent()->getEntity($this->getSettingsName());
        $this[$this->getSettingsName()]->setDefaultValue($entity->getValue());
    }

    /** {@inheritdoc} */
    public function update($form, $values)
    {
        $entity = $form->getEntity($this->getSettingsName());

        return $entity
                    ->setType($this->getSettingsType())
                    ->setName($this->getSettingsName())
                    ->setValue($values[$this->getSettingsName()]);
    }

    /**
     * Get settings type
     *
     * @return string
     */
    abstract protected function getSettingsType();

    /**
     * Get settings name
     *
     * @return string
     */
    abstract protected function getSettingsName();

    /**
     * Get settings title
     *
     * @return string
     */
    abstract protected function getSettingsTitle();

}