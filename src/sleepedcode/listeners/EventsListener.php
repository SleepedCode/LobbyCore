<?php

namespace sleepedcode\listeners;

use sleepedcode\formapi\ServerForm;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat;

class EventsListener implements Listener {

    public function onJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $player->getInventory()->clearAll();
        $player->getInventory()->setItem(4, VanillaItems::NETHER_STAR()->setCustomName(TextFormat::colorize("&r&l&6Servers Form")));
    }

    public function onUse(PlayerItemUseEvent $event): void {
        if($event->getItem()->getCustomName() === TextFormat::colorize("&r&l&6Servers Form")){
            (new ServerForm())->send($event->getPlayer());
        }
    }

    public function onPlace(BlockPlaceEvent $event): void {
        if(!$event->getPlayer()->getServer()->isOp($event->getPlayer()->getName())){
            $event->cancel();
        }
    }
      
    public function onBreak(BlockBreakEvent $event): void {
        if(!$event->getPlayer()->getServer()->isOp($event->getPlayer()->getName())){
            $event->cancel();
        }
    }

    public function onDrop(PlayerDropItemEvent $event): void {
        if(!$event->getPlayer()->getServer()->isOp($event->getPlayer()->getName())){
            $event->cancel();
        }
    }

}