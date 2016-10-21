<?php

namespace Muqsit;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\Server;

class Main extends PluginBase {

  public function onEnable(){
    if(!file_exists($this->getDataFolder() . "help.yml")) {
      @mkdir($this->getDataFolder());
      file_put_contents($this->getDataFolder() . "help.yml",$this->getResource("help.yml"));
    }
    $this->saveDefaultConfig();
    $this->getServer()->getCommandMap()->getCommand("help")->setLabel("help_not_anymore");
    $this->getServer()->getCommandMap()->getCommand("help")->unregister($this->getServer()->getCommandMap());
  }
}
