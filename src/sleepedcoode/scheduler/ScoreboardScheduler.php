<?php

namespace sleepedcode\scheduler;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use sleepedcode\scoreboard\ScoreboardBuilder;

class ScoreboardScheduler extends Task {

    public function onRun(): void {
        foreach(Server::getInstance()->getOnlinePlayers() as $player){
            if(!$player->isOnline()) return;
            $build = new ScoreboardBuilder();
            $build->build($player);
        }
    }

}