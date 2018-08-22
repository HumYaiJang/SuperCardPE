<?php

namespace EasyCard

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777/FormAPI;
use onebone\economyapi\EconomyAPI;

Class Main extends PluginBase{
    
    public function onEnable(){
        $this->getLogger()->notice("§eSuperCard §bEnable §7Present by HumYaiJang");
    }
    
    public function checkEconomy() : bool {
    
    }
}
