<?php

namespace Wame\SettingsModule\Vendor\Wame\AdminModule\Forms\Containers;

use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\SettingsModule\Vendor\Wame\AdminModule\Forms\Containers\SettingsContainer;

interface IDescriptionContainerFactory extends IBaseContainer
{
    /** @return DescriptionContainer */
    public function create();
}

class DescriptionContainer extends SettingsContainer
{
    /** {@inheritdoc} */
    protected function getSettingsType()
    {
        return 'general';
    }

    /** {@inheritdoc} */
    protected function getSettingsName()
    {
        return 'description';
    }

    /** {@inheritdoc} */
    protected function getSettingsTitle()
    {
        return _('Description');
    }

    /** {@inheritdoc} */
    protected function getSettingsDescription()
    {
        return _('Main page description, that is displayed in the browser header.');
    }

}