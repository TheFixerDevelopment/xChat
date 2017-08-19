<?php

namespace Rysieeku;

use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

  public $cfg;

  public function onLoad(){
    $this->getLogger()->info(TF::YELLOW."Loading xChatClear...");
  }
 
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
      @mkdir($this->getDataFolder());
    $this->cfg = $this->getConfig();
    $this->saveDefaultConfig();
    $this->getLogger()->info(TF::GREEN."xChatClear by Rysieeku loaded!");
  }
 
  public function onDisable(){
    $this->getLogger()->info(TF::RED."xChatClear disabled!");
  }
  
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    $cm = $this->cfg->get("clear-message");
    $cm = str_replace("{PLAYER}", $sender->getName(), $cm);
    $np = $this->cfg->get("no-permission");
    $cm2 = $this->cfg->get("clear-message-player");
    switch($command->getName()){
      case "clearchat":
      case "cc":
      case "chatclear":
        if($sender->hasPermission("xchat.clear")){
          $this->getServer()->broadcastMessage("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
          $this->getServer()->broadcastMessage(TF::GREEN."".$cm."");
          $sender->sendMessage(TF::GREEN."".$cm2."");
        return true;
        }
        else {
          $sender->sendMessage(TF::RED."".$np."");
        return true;
        }
      return false;
      case "xchat":
        if($sender->hasPermission("xchat.xchat")){
          $sender->sendMessage(TF::GRAY."Hi, ".TF::YELLOW.$sender->getName());
          $sender->sendMessage(TF::GRAY."You are currently using ".TF::YELLOW."xChatClear".TF::GRAY." version ".TF::YELLOW."1.0".TF::GRAY." by ".TF::YELLOW."Rysieeku");
        return true;
        }
        else {
          $sender->sendMessage(TF::RED."".$np."");
        return true;
        }
      return false;
    }
  }
}
