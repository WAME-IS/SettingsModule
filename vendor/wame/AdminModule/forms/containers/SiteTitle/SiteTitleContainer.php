<?php

namespace Wame\SettingsModule\Vendor\Wame\AdminModule\Forms\Containers;

use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\SettingsModule\Vendor\Wame\AdminModule\Forms\Containers\SettingsContainer;

interface ISiteTitleContainerFactory extends IBaseContainer
{
    /** @return SiteTitleContainer */
    public function create();
}

class SiteTitleContainer extends SettingsContainer
{
    /** {@inheritdoc} */
    protected function getSettingsType()
    {
        return 'general';
    }

    /** {@inheritdoc} */
    protected function getSettingsName()
    {
        return 'siteTitle';
    }

    /** {@inheritdoc} */
    protected function getSettingsTitle()
    {
        return _('Site title');
    }

    /** {@inheritdoc} */
    protected function getSettingsDescription()
    {
        return _('Main page title, that is displayed in the browser header.');
    }

}