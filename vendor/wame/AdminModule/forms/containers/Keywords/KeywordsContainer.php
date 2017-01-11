<?php

namespace Wame\SettingsModule\Vendor\Wame\AdminModule\Forms\Containers;

use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\SettingsModule\Vendor\Wame\AdminModule\Forms\Containers\SettingsContainer;

interface IKeywordsContainerFactory extends IBaseContainer
{
    /** @return KeywordsContainer */
    public function create();
}

class KeywordsContainer extends SettingsContainer
{
    /** {@inheritdoc} */
    protected function getSettingsType()
    {
        return 'general';
    }

    /** {@inheritdoc} */
    protected function getSettingsName()
    {
        return 'keywords';
    }

    /** {@inheritdoc} */
    protected function getSettingsTitle()
    {
        return _('Keywords');
    }

    /** {@inheritdoc} */
    protected function getSettingsDescription()
    {
        return _('Main page keywords, that is displayed in the browser header.');
    }

}