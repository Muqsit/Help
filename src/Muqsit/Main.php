<?php

namespace Muqsit;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

    public function onEnable(){
      if(!file_exists($this->getDataFolder() . "help.yml")) {
      @mkdir($this->getDataFolder());
      file_put_contents($this->getDataFolder() . "help.yml",$this->getResource("help.yml"));
      }
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function PlayerCommandPreprocessEvent(PlayerCommandPreprocessEvent $event){
      $this->helpcfg = new Config($this->getDataFolder()."help.yml", Config::YAML);
      $command = explode(" ", strtolower($event->getMessage()));
      $player = $event->getPlayer();
      $protect = $this->helpcfg->get("pages");

      if($command[0] === "/help" or $command[0] === "/?"){
      if($command[1] > 0 && $command[1] < $protect + 1){
        $messages = $this->helpcfg->get("page." . $command[1]);
         foreach($messages as $msges){
            $player->sendMessage($msges);
            $event->setCancelled();
            }
         }elseif($command[1] < 1 or $command[1] > $protect){
          $helpInitial = $this->helpcfg->get("page.1");
               foreach($helpInitial as $helpInit){
               $player->sendMessage($helpInit);
               $event->setCancelled();
           }
        }
     }
  }
}
