<?php

namespace Wame\SettingsModule\Vendor\Wame\MenuModule\Components\MenuControl\AdminMenu;

use Nette\Application\LinkGenerator;
use Wame\MenuModule\Models\IMenuItem;
use Wame\MenuModule\Models\Item;

interface IAdminMenuItem
{
	/** @return AdminMenuItem */
	public function create();
}


class AdminMenuItem implements IMenuItem
{	
    /** @var LinkGenerator */
	private $linkGenerator;
	
	
	public function __construct(
		LinkGenerator $linkGenerator
	) {
		$this->linkGenerator = $linkGenerator;
	}
	
	
	public function addItem()
	{
		$item = new Item();
		$item->setName('settings');
		$item->setTitle(_('Settings'));
		$item->setIcon('fa fa-cog');
		$item->setLink($this->linkGenerator->link('Admin:Settings:', ['id' => null]));
		
		return $item->getItem();
	}

}
