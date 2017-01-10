<?php

namespace Wame\SettingsModule\Repositories;

use Wame\Core\Exception\RepositoryException;
use Wame\Core\Repositories\BaseRepository;
use Wame\SettingsModule\Entities\SettingsEntity;

class SettingsRepository extends BaseRepository
{
	const STATUS_REMOVE = 0;
	const STATUS_ACTIVE = 1;

	
    public function __construct()
    {
        parent::__construct(SettingsEntity::class);
    }


	/**
	 * Create settings
	 * 
	 * @param SettingsEntity $settingsEntity entity
	 * @return SettingsEntity
	 * @throws RepositoryException
	 */
	public function create($settingsEntity)
	{
		$create = $this->entityManager->persist($settingsEntity);
		
		if (!$create) {
			throw new RepositoryException(_('Settings could not be created.'));
		}
		
		return $settingsEntity;
	}

    /**
     * Update settings
     *
     * @param SettingsEntity $settingsEntity
     * @return SettingsEntity
     */
	public function update($settingsEntity)
	{
		return $settingsEntity;
	}

}