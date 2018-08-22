<?php

namespace EasyCard

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\item\Item;

use pocketmine\event\Listener;
use jojoe77777\FormAPI;
use onebone\economyapi\EconomyAPI;

Class Main extends PluginBase{
    
    public function onEnable(){
        $this->saveResource("config.yml");
        $this->getLogger()->notice("§eSuperCard §bEnable §7Present by HumYaiJang");
    }
    
    public function checkPlugin() : bool {
        if($this->getServer()->getPluginManager()->getPlugin("EconomyAPI") === null or $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->isDisbled()){ 
            $this->getPluginLoader()->disablePlugin($this);
            $this->getLogger()->error("[ERROR] => SuperCard disabling now! Because the server don't have 'EconomyAPI' !");
            return false;
        }
        if($this->getServer()->getPluginManager()->getPlugin("FormAPI") === null or $this->getServer()->getPluginManager()->getPlugin("FormAPI")->isDisabled()){
            $this->getPluginLoader()->disablePlugin($this);
            $this->getLogger()->error("[Error] => SuperCard is disibling now! FormAPI not found in 'plugins' !");
            return false;
        }
    }
    
    public function onCommand(CommandSender $sender, Command $command, String $label, array $args) : bool {
        if($command->getName() === "supercard"){
            if(!$sender->hasPermission("super.card.cmd")){
                $sender->sendMessage("§cYou don't have a Operator or Permission");
            }
            if(empty($args[0])){
                $sender->sendMessage("§eUsage: §a/supercard §r<buy|create|help>");
            }
            switch($args[0]){
                case "buy":
                    $economyapi = EconomyAPI::getInstance();
                    $mymoney = $economyapi->myMoney($sender);
                    $cash = $this->getConfig()->get("price-supercard");
                    if($mymoney >= $cash){
                        $economyapi->reduceMoney($sender, $cash);
                        $sender->sendMessage("§aSuccessed to buy SuperCard! In price §b$cash");
                        $sender->addTitle("§aSuccessed!", "§fBuy SuperCard");
                        $item = Item::get();
                        $sender->getInventory()->addItem($item);
                    } else {
                        $sender->sendMessage("§cYou don't have enought money for buy SuperCard");
                    }
                case "help":
                    $cash = $this->getConfig()->get("price-supercard");
                    $sender->sendMessage("
                    §2===========================
                    §a/supercard buy §r=> for buy super card in $cash
                    §a/supercard create §f=> for operator or player have permission to create a supercard free!
                    §a/supercard help §f=> for read infomation or read a commands about of SuperCard Plugin!
                    §2===========================
                    ");
            }
            $this->mainForm($sender);
        }
        return true;
    }
    
    public function mainForm($sender){
        
    }
}
