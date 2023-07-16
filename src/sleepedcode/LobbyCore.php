<?php

namespace sleepedcode;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use sleepedcode\listeners\EventsListener;
use sleepedcode\scheduler\ScoreboardScheduler;

class LobbyCore extends PluginBase {

    use SingletonTrait;

    protected function onEnable(): void {
        self::setInstance($this);
        $this->saveDefaultConfig();
        $this->getScheduler()->scheduleRepeatingTask(new ScoreboardScheduler(), 20);
        $this->getServer()->getPluginManager()->registerEvents(new EventsListener(), $this);
    }
    
}