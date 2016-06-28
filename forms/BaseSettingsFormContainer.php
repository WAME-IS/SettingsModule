<?php

namespace Wame\SettingsModule\Forms;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\SettingsModule\Entities\SettingsEntity;
use Wame\SettingsModule\Repositories\SettingsRepository;


class BaseSettingsFormContainer extends BaseFormContainer
{
	/** @var SettingsRepository */
	private $settingsRepository;


	public function __construct(
		SettingsRepository $settingsRepository
	) {
		parent::__construct();
		
		$this->settingsRepository = $settingsRepository;
	}
	
	
	/**
	 * Prepare value
	 * 
	 * @param Form $object
	 */
    public function attached($object) 
	{
        parent::attached($object);

        if ($object instanceof Form) {
            $object->onSuccess[] = function (Form $form) 
			{
				$this->getValue($form);
				
				$this->setValue($form, $this->getValue($form), $this->getInputName());

				return $form;
            };
        }
    }
	
	
	/**
	 * Create or update
	 * 
	 * @param Form $form
	 * @param string $value
	 * @param string $inputName
	 */
	private function setValue($form, $value, $inputName)
	{	
		if (isset($form->parent->settingsEntity[$inputName])) {
			if ($form->parent->settingsEntity[$inputName]->getValue() != $value) {
				$settingsEntity = $form->parent->settingsEntity[$inputName];
				$settingsEntity->setValue($value);
				$settingsEntity->setEditDate(new \DateTime('now'));
				$settingsEntity->setEditUser($form->parent->user->getEntity());

				$this->settingsRepository->update($settingsEntity);
			}
		} else {
			$settingsEntity = new SettingsEntity();
			$settingsEntity->setType($form->parent->id);
			$settingsEntity->setName($inputName);
			$settingsEntity->setStatus(SettingsRepository::STATUS_ACTIVE);
			$settingsEntity->setValue($value);
			$settingsEntity->setEditDate(new \DateTime('now'));
			$settingsEntity->setEditUser($form->parent->user->getEntity());
			
			$this->settingsRepository->create($settingsEntity);
		}
	}


	/**
	 * Set default value
	 * 
	 * @param Form $object
	 */
	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$inputName = $this->getInputName();
		
		if (isset($object->settingsEntity[$inputName])) {
			$form[$inputName]->setDefaultValue($object->settingsEntity[$inputName]);
		}
	}

	
	/**
	 * Configure form controls
	 */
	protected function configure() {
		parent::configure();
	}

}
