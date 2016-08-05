<?php

namespace Wame\SettingsModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\SettingsModule\Entities\SettingsEntity;


class SettingsRepository extends BaseRepository
{
	const STATUS_REMOVE = 0;
	const STATUS_ACTIVE = 1;

	
    public function __construct(
		\Nette\DI\Container $container, 
		\Kdyby\Doctrine\EntityManager $entityManager, 
		\h4kuna\Gettext\GettextSetup $translator, 
		\Nette\Security\User $user
	) {
        parent::__construct($container, $entityManager, $translator, $user, SettingsEntity::class);
    }


	/**
	 * Create settings
	 * 
	 * @param SettingsEntity $settingsEntity
	 * @return SettingsEntity
	 * @throws \Wame\Core\Exception\RepositoryException
	 */
	public function create($settingsEntity)
	{
		$create = $this->entityManager->persist($settingsEntity);
		
		if (!$create) {
			throw new \Wame\Core\Exception\RepositoryException(_('Settings could not be created.'));
		}
		
		return $settingsEntity;
	}


	/**
	 * Update settings
	 * 
	 * @param SettingsEntity $settingsEntity
	 */
	public function update($settingsEntity)
	{
		return $settingsEntity;
	}

}