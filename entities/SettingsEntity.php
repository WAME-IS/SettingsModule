<?php

namespace Wame\SettingsModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\BaseEntity;
use Wame\Core\Entities\Columns;


/**
 * @ORM\Table(name="wame_settings")
 * @ORM\Entity
 */
class SettingsEntity extends BaseEntity 
{
	use Columns\Identifier;
	use Columns\EditDate;
	use Columns\EditUser;
	use Columns\Name;
	use Columns\Status;


	/**
	 * @ORM\Column(name="type", type="string")
	 */
	protected $type;
	
	/**
	 * @ORM\Column(name="value", type="string", nullable=true)
	 */
	protected $value;
	
	
	/** get ************************************************************/

	public function getType()
	{
		return $this->type;
	}

	public function getValue()
	{
		return $this->value;
	}


	/** set ************************************************************/

	public function setType($type)
	{
		$this->type = $type;
		
		return $this;
	}

	public function setValue($value)
	{
		$this->value = $value;
		
		return $this;
	}

}