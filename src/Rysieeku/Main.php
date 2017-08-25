<?php
namespace Rysieeku;


/*
* xChat 1.1
* Author: Rysieeku
* API: 3.0.0-ALPHA6
*/

use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener{

  public $cfg;

  public function onLoad(){
    $this->getLogger()->info(TF::YELLOW."Loading...");
  }
 
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
      @mkdir($this->getDataFolder());
    $this->saveDefaultConfig();
    $this->checkConfig();
    $this->getLogger()->info(TF::GREEN."xChat by Rysieeku loaded!");
  }
 
  public function onDisable(){
    $this->getLogger()->info(TF::RED."xChat disabled!");
  }
  
  private function checkConfig(){
    if(!$this->getConfig()->exists("version") || $this->getConfig()->get("version") !== "1.1"){
    $this->getLogger()->info(TF::RED."Invalid config file found, generating a new one...");
    unlink($this->getDataFolder() . "config.yml");
    $this->saveDefaultConfig();
    }
  }
  
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    $msg = $this->getConfig()->get("clear-message");
    $msg = str_replace("{PLAYER}", $sender->getName(), $msg);
    $pmsg = $this->getConfig()->get("clear-message-player");
    $ecmsg = $this->getConfig()->get("enable-chat-message");
    $ecbc = $this->getConfig()->get("enable-chat-broadcast");
    $ecbc = str_replace("{PLAYER}", $sender->getName(), $ecbc);
    $dcmsg = $this->getConfig()->get("disable-chat-message");
    $dcbc = $this->getConfig()->get("disable-chat-broadcast");
    $dcbc = str_replace("{PLAYER}", $sender->getName(), $dcbc);
    $pdcmsg = $this->getConfig()->get("chat-disabled-message");
    $np = $this->getConfig()->get("no-permission");
    switch(strtolower($command->getName())){
      case "c":
      case "chat":
      case "xchat":
        if(isset($args[0])){
          if(strtolower($args[0]) == "clear"){
            if($sender->hasPermission("xchat.chat.clear") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $this->getServer()->broadcastMessage("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
              $this->getServer()->broadcastMessage(TF::GREEN.$msg);
              $sender->sendMessage(TF::GREEN.$pmsg);
              return true;
            }
            else {
              $sender->sendMessage(TF::RED.$np);
              return true;
            }
          }
          elseif(strtolower($args[0]) == "info"){
            if($sender->hasPermission("xchat.cmd.info") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Info".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
              $sender->sendMessage(TF::GRAY."Author -".TF::YELLOW." Rysieeku");
              $sender->sendMessage(TF::GRAY."Version -".TF::YELLOW." 1.2");
              $sender->sendMessage(TF::GRAY."E-mail -".TF::YELLOW." rysieeku@upblock.pl");
              return true;
            }
            else {
              $sender->sendMessage(TF::RED.$np);
              return true;
            }
          }
          elseif(strtolower($args[0]) == "help"){
            if($sender->hasPermission("xchat.cmd.help") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Available commands".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
              $sender->sendMessage(TF::YELLOW."/xchat help".TF::GRAY." - Available commands");
              $sender->sendMessage(TF::YELLOW."/xchat info".TF::GRAY." - Info about plugin");
              $sender->sendMessage(TF::YELLOW."/xchat clear".TF::GRAY." - Clear chat");
              $sender->sendMessage(TF::YELLOW."/xchat reload".TF::GRAY." - Reload config file");
              $sender->sendMessage(TF::YELLOW."/xchat enable".TF::GRAY." - Enable chat");
              $sender->sendMessage(TF::YELLOW."/xchat disable".TF::GRAY." - Disable chat");
              $sender->sendMessage(TF::GRAY."Showing page ".TF::YELLOW."1".TF::GRAY." of ".TF::YELLOW."1");
              return true;
            }
            else {
              $sender->sendMessage(TF::RED.$np);
              return true;
            }
          }
          elseif(strtolower($args[0]) == "enable"){
            if($sender->hasPermission("xchat.chat.enable") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $this->getConfig()->set("chat","enabled");
              $this->getConfig()->save();
              $sender->sendMessage(TF::GREEN.$ecmsg);
              $this->getServer()->broadcastMessage(TF::GRAY.$ecbc);
              return true;
            }
            else {
              $sender->sendMessage(TF::RED.$np);
              return true;
            }
          }
          elseif(strtolower($args[0]) == "disable"){
            if($sender->hasPermission("xchat.chat.disable") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $this->getConfig()->set("chat","disabled");
              $this->getConfig()->save();
              $sender->sendMessage(TF::GREEN.$dcmsg);
              $this->getServer()->broadcastMessage(TF::GRAY.$dcbc);
              return true;
            }
            else {
              $sender->sendMessage(TF::RED.$np);
              return true;
            }
          }
          elseif(strtolower($args[0]) == "reload"){
            if($sender->hasPermission("xchat.reload") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $this->reloadConfig();
              $sender->sendMessage(TF::GREEN."[xChat] Configuration file has been reloaded!");
              return true;
            }
            else {
              $sender->sendMessage(TF::RED.$np);
              return true;
             }
           }
         }
       }
     }
  public function onChat(PlayerChatEvent $event){
    $player = $event->getPlayer();
    if($this->getConfig()->getAll()["chat"] == "disabled"){
      $event->setCancelled(true);
      $player->sendMessage(TF::RED.$pdcmsg);
      return true;
    }
    else {
      return true;
    }
  }
}
