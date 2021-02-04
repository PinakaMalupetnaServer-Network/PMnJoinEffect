<?php

namespace Clarence2810\PMnJoinEffect;

use pocketmine\{
	Player,
	Server,
	event\Listener,
	plugin\PluginBase,
	event\player\PlayerJoinEvent,
	item\Item,
	network\mcpe\protocol\LevelEventPacket,
	network\mcpe\protocol\ActorEventPacket,
	entity\Effect,
	entity\EffectInstance,
	utils\Textformat as C,
};;
class Main extends PluginBase implements Listener
{
	public function onEnable()
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("Plugin by Clarence2810 has been enabled");
	}
	public function onJoin(PlayerJoinEvent $event):void{
		$player = $event->getPlayer();
		$player->setGamemode(0);
		$player->setFood($player->getMaxFood());
        $player->addTitle(C::YELLOW . "Welcome to " . C::GOLD . "PMnS", C::AQUA . "Season One", 5, 100, 20);
        $player->getInventory()->setItemInHand(Item::get(450, 0, 1));
		$player->broadcastEntityEvent(ActorEventPacket::CONSUME_TOTEM);
		$player->getLevel()->broadcastLevelEvent($player->add(0, $player->getEyeHeight()), LevelEventPacket::EVENT_SOUND_TOTEM);
		$player->broadcastEntityEvent(ActorEventPacket::FIREWORK_PARTICLES);
		$player->getLevel()->broadcastLevelEvent($player->add(0, $player->getEyeHeight()), LevelEventPacket::EVENT_SOUND_PORTAL);
		$player->addEffect(new EffectInstance(Effect::getEffect(Effect::BLINDNESS), 10 * 20, 2, true));
		$player->getInventory()->setItemInHand(Item::get(0, 0, 1));
	}
}