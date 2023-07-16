<?php

namespace sleepedcode\scoreboard;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use sleepedcode\LobbyCore;

class ScoreboardBuilder {

    public function build(Player $player): void {
        $config = LobbyCore::getInstance()->getConfig();
        $sb = new Scoreboard($player, TextFormat::colorize($config->get("scoreboard")["title"]));
        $sb->clear();
        foreach($config->get("scoreboard")["lines"] as $line){
            $sb->addLine(TextFormat::colorize(str_replace(["{name}", "{players}"], [$player->getName(), count(Server::getInstance()->getOnlinePlayers())], $line)));
        }
        $sb->init();
    }

}