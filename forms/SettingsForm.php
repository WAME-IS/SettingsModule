<?php

namespace Wame\SettingsModule\Forms;

use Nette\Application\UI\Form;
use Kdyby\Doctrine\EntityManager;
use Wame\Utils\Strings;
use Wame\Core\Forms\FormFactory;
use Wame\SettingsModule\Entities\SettingsEntity;
use Wame\SettingsModule\Repositories\SettingsRepository;


class SettingsForm extends FormFactory
{	
	/** @var EntityManager */
	private $entityManager;
	
	/** @var SettingsRepository */
	private $settingsRepository;
	
	/** @var SettingsEntity */
	public $settingsEntity;
	
	/** @var string */
	public $lang;
	
	/** @var mixed */
	public $type;
	
	
	public function __construct(
		EntityManager $entityManager, 
		SettingsRepository $settingsRepository
	) {
		parent::__construct();

		$this->entityManager = $entityManager;
		$this->settingsRepository = $settingsRepository;
		
		$this->lang = $settingsRepository->lang;
	}
	
	
	public function setType($type) 
	{
		$this->id = Strings::getClassName($type);
		$this->type = $type;
		
		return $this;
	}

	
	protected function attached($object) {
		parent::attached($object);
	}
	
	
	public function build()
	{
		$this->addFormContainers($this->type->getFormContainers());
				
		$form = $this->createForm();

		if (count($this->getFormContainers()) > 0) {
			$form->addSubmit('submit', _('Save'));

			$this->settingsEntity = $this->settingsRepository->findPairs(['type' => $this->id], 'value', [], 'name');
			
			$this->setDefaultValues();
		}

		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		try {
			$this->settingsRepository->onUpdate($form, $values);

			$presenter->flashMessage(_('Settings has been successfully updated.'), 'success');
			$presenter->redirect('this');
		} catch (\Exception $e) {
			if ($e instanceof \Nette\Application\AbortException) {
				throw $e;
			}
			
			$form->addError($e->getMessage());
			$this->entityManager->clear();
		}
	}

}
