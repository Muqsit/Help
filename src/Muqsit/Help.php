<?php
namespace Muqsit;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class HelpCommand extends Command {

    public function __construct(Main $plugin){
        parent::__construct("help", "For noobs", null, ["?"]);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $issuer, $alias, array $args){
        if(!$this->testPermission($issuer)) return true;
        $protect = $this->plugin->help->get("pages");
        if (isset($args[0]) && $args[0] > 0 && $args[0] < $protect + 1) {
            $messages = $this->plugin->help->get("page." . $args[0]);
            foreach ($messages as $msg) {
                $issuer->sendMessage($msg);
            }
        } elseif (!isset($args[0]) or $args[0] > $protect or $args[0] < 1) {
            $helpInitial = $this->plugin->help->get("page.1");
            foreach ($helpInitial as $helpInit) {
                $issuer->sendMessage($helpInit);
            }
        }
        return true;
    }
}
