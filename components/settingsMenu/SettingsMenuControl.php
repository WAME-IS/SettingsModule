<?php

namespace Wame\SettingsModule\Components;

use Nette\DI\Container;
use Wame\AdminModule\Components\BaseControl;
use Wame\SettingsModule\Models\SettingsManager;
use Wame\Utils\HttpRequest;

interface ISettingsMenuControlFactory
{

    /** @return SettingsMenuControl */
    public function create();
}

class SettingsMenuControl extends BaseControl
{

    /** @var SettingsManager */
    private $settingsManager;

    /** @var integer */
    private $id;

    public function __construct(
    Container $container, HttpRequest $httpRequest, SettingsManager $settingsManager
    )
    {
        parent::__construct($container);

        $this->settingsManager = $settingsManager->getTypes();

        $this->id = $httpRequest->getParameter('id');
    }

    public function render()
    {
        $this->template->types = $this->settingsManager;
    }
}
