<?php

declare(strict_types=1);

namespace dondesc;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;

final class DonateDescription extends PluginBase {

    public function onEnable(): void {
        $this->saveResource("config.yml");
        if (!is_dir($this->getDataFolder())) {
            mkdir($this->getDataFolder());
        }
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args): bool {
        if (count($args) === 0) {
            $sender->sendMessage($this->getConfig()->get("donate-list"));
            return true;
        }
        if (!$this->getConfig()->exists($args[0])) {
            $sender->sendMessage($this->getConfig()->get("donate-not-found"));
            return true;
        }
        $sender->sendMessage($this->getConfig()->get($args[0])[0]);
        return true;
    }
}