<?php

namespace App\AdminModule\Presenters;

use Wame\DynamicObject\Forms\RowForm;
use Wame\SettingsModule\Repositories\SettingsRepository;

abstract class AbstractSettingsPresenter extends BasePresenter
{
    /** @var SettingsRepository @inject */
    public $repository;


    /** execution *************************************************************/

    /**
     * Action default
     */
    public function actionDefault()
    {
//        $this->count = $this->repository->countBy();
    }


    /** renders ***************************************************************/

    /**
     * Render default
     */
    public function renderDefault()
    {
        $this->template->siteTitle = _('Settings');
    }

    /** components ************************************************************/

    /**
     * Create component form
     *
     * @return RowForm form
     */
    protected function createComponentForm()
    {
        /** @var RowForm $form */
        $form = $this->context
            ->getService($this->getFormBuilderServiceAlias())
            ->build();

        return $form;
    }


    /** abstract methods ******************************************************/

    /**
     * Get form builder service alias
     *
     * @return string
     */
    abstract protected function getFormBuilderServiceAlias();

}