<?php
namespace AntiReach;

use pocketmine\plugin\PluginBase;
use pocketmine\command\{Command, CommandSender};
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\event\entity\{EntityDamageEvent, EntityDamageByEntityEvent};

class Main extends PluginBase implements Listener {

  public function onEnable() {
    @mkdir($this->getDataFolder());
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }

  public function onDamage(EntityDamageEvent $event) {
    if($event instanceof EntityDamageByEntityEvent) {
      $attacker = $event->getDamager();
      $victim = $event->getEntity();
      $distance = $attacker->distance($victim->getPosition());

   if($distance > 5 && $attacker->getLevel()->getName() == $victim->getLevel()->getName()) {
    if($attacker instanceof Player) {
      if($attacker->getInventory()->getItemInHand()->getId() == Item::BOW) {
        return;
      }else{
        $event->setCancelled();
      }
    }
  }
}
