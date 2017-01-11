<?php

namespace App\AdminModule\Presenters;

class GeneralSettingsPresenter extends AbstractSettingsPresenter
{
    /** renders ***************************************************************/

    public function renderDefault()
    {
        parent::renderDefault();

        $this->template->subTitle = _('General');
    }


    /** implements ************************************************************/

    /** {@inheritdoc} */
    protected function getFormBuilderServiceAlias()
    {
        return 'Admin.GeneralSettingsFormBuilder';
    }

}