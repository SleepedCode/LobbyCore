<?php

namespace sleepedcode\formapi;

use sleepedcode\LobbyCore;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class ServerForm {

    public function send(Player $player): void {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) return;
            $servers = LobbyCore::getInstance()->getConfig()->get("servers");
            $selectedServer = array_keys($servers)[$data];
            $ipport = explode(":", $servers[$selectedServer]["ip_port"]);
            $player->transfer($ipport[0], $ipport[1]);
        });
        $servers = LobbyCore::getInstance()->getConfig()->get("servers");
        foreach ($servers as $server => $data) {
            $form->addButton(TextFormat::colorize($data["format"]));
        }
        $form->setTitle(TextFormat::colorize("&l&6Servers Form"));
        $player->sendForm($form);
    }

}