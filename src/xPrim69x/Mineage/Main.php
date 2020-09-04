<?php

declare(strict_types=1);

namespace xPrim69x\Mineage;

use pocketmine\{Server, Player};
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\command\{CommandSender, Command};

use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		if(isset($args[0])){
            switch ($args[0]){
			case "on":
				$this->getConfig()->set("blocks", true);
                $this->getConfig()->save();
                $sender->sendMessage("§bMineage has been enabled!");
			break;
            case "off":
                $this->getConfig()->set("blocks", false);
                $this->getConfig()->save();
                $sender->sendMessage("§bMineage has been disabled!");
            break;
            default:
                $sender->sendMessage("§d Usage:§b /mineage <on:off>");
            break;
        	}
        } else {
            $sender->sendMessage("§d Usage:§b /mineage <on:off>");
        }
        return true;
    }
    public function breakBlock(BlockBreakEvent $event){
    	if($this->getConfig()->get("blocks") === true){
    		$player = $event->getPlayer();
			$block = $event->getBlock();
			$blocks = [13, 1, 4, 2, 3];
			$p = $block->getId() == 1;
			$d = $block->getDamage();
		if(in_array($block->getId(), $blocks) || ($p && $d == 1) || ($p && $d == 3) || ($p && $d == 5)){
					$event->setDrops([]);
			}
    	}
	}

}
