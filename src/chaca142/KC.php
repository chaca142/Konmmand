<?php

namespace chaca142;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\Config;

class KC extends PluginBase implements Listener{

    public function onEnable(){

        if(!file_exists($this->getDataFolder())) {
            mkdir($this->getDataFolder(), true);
        }
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->set = new Config($this->getDataFolder() . "message.yml", CONFIG::YAML,array(
            "メッセージ"=>"こんちゃ",
        ));
        $this->set->save();
        $this->getLogger()->info('§aKonmmandを読み込みました');

    }

    public function onDisable(){

        $this->getLogger()->info('§cKonmmandを停止しました');

    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool
    {
        switch (strtolower($command->getName())) {

            case "kon":

                if (!$sender instanceof Player) {
                    $message = $this->set->get("メッセージ");
                    $this->getServer()->broadcastMessage("§d[Server]".$message."");
                }else{
                    $message = $this->set->get("メッセージ");
                    $player = $sender->getPlayer();
                    $name = $player->getName();
                    $this->getServer()->broadcastMessage("<".$name."> ".$message."");
                }
        }
     return false;
    }
}