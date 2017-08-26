<?php
namespace Rysieeku\xChat;


/*
* xChat 1.3.1
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
use pocketmine\Player;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener{

  public $cfg;
  
  public function betterColors($symbol, $message){
    $message = str_replace($symbol."0", TF::BLACK, $message);
    $message = str_replace($symbol."1", TF::DARK_BLUE, $message);
    $message = str_replace($symbol."2", TF::DARK_GREEN, $message);
    $message = str_replace($symbol."3", TF::DARK_AQUA, $message);
    $message = str_replace($symbol."4", TF::DARK_RED, $message);
    $message = str_replace($symbol."5", TF::DARK_PURPLE, $message);
    $message = str_replace($symbol."6", TF::GOLD, $message);
    $message = str_replace($symbol."7", TF::GRAY, $message);
    $message = str_replace($symbol."8", TF::DARK_GRAY, $message);
    $message = str_replace($symbol."9", TF::BLUE, $message);
    $message = str_replace($symbol."a", TF::GREEN, $message);
    $message = str_replace($symbol."b", TF::AQUA, $message);
    $message = str_replace($symbol."c", TF::RED, $message);
    $message = str_replace($symbol."d", TF::LIGHT_PURPLE, $message);
    $message = str_replace($symbol."e", TF::YELLOW, $message);
    $message = str_replace($symbol."f", TF::WHITE, $message);
    $message = str_replace($symbol."k", TF::OBFUSCATED, $message);
    $message = str_replace($symbol."l", TF::BOLD, $message);
    $message = str_replace($symbol."m", TF::STRIKETHROUGH, $message);
    $message = str_replace($symbol."n", TF::UNDERLINE, $message);
    $message = str_replace($symbol."o", TF::ITALIC, $message);
    $message = str_replace($symbol."r", TF::RESET, $message);
    return $message;
  }
  
  public function onLoad(){
    $this->getLogger()->info(TF::YELLOW."Loading...");
  }
 
  public function onEnable(){
    if(!is_dir($this->getDataFolder())){
      mkdir($this->getDataFolder());
    }
    $this->checkConfig();
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(TF::GREEN."xChat by Rysieeku loaded!");
  }
 
  public function onDisable(){
    $this->getLogger()->info(TF::RED."xChat disabled!");
  }
  
  private function checkConfig(){
    if(!file_exists($this->getDataFolder() . "config.yml")){
      $this->saveDefaultConfig();
    }
    if(!file_exists($this->getDataFolder() . "muted.txt")){
    }
      $this->playersMuted = new Config($this->getDataFolder() . "muted.txt", Config::ENUM);
  }
  
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    $np = $this->getConfig()->get("no-permission");
    switch(strtolower($command->getName())){
      case "c":
      case "chat":
      case "xchat":
        if(isset($args[0])){
          if(strtolower($args[0]) == "clear"){
            if($sender->hasPermission("xchat.clear") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $msg = $this->getConfig()->get("clear-message");
              $msg = str_replace("{PLAYER}", $sender->getName(), $msg);
              $pmsg = $this->getConfig()->get("clear-message-player");
              $this->getServer()->broadcastMessage("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
              $this->getServer()->broadcastMessage($this->betterColors("&", "&e".$msg));
              $sender->sendMessage($this->betterColors("&", "&e".$pmsg));
              return true;
            }
            else {
              $sender->sendMessage($this->betterColors("&", "&c".$np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "info"){
            if($sender->hasPermission("xchat.info") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Info".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
              $sender->sendMessage(TF::GRAY."Author -".TF::YELLOW." Rysieeku");
              $sender->sendMessage(TF::GRAY."Version -".TF::YELLOW." 1.3.1");
              $sender->sendMessage(TF::GRAY."E-mail -".TF::YELLOW." rysieeku@upblock.pl");
              return true;
            }
            else {
              $sender->sendMessage($this->betterColors("&", "&c".$np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "help"){
            if($sender->hasPermission("xchat.help") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Available commands".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
              $sender->sendMessage(TF::YELLOW."/xchat help".TF::GRAY." - Available commands");
              $sender->sendMessage(TF::YELLOW."/xchat info".TF::GRAY." - Info about plugin");
              $sender->sendMessage(TF::YELLOW."/xchat clear".TF::GRAY." - Clear chat");
              $sender->sendMessage(TF::YELLOW."/xchat reload".TF::GRAY." - Reload config file");
              $sender->sendMessage(TF::YELLOW."/xchat enable".TF::GRAY." - Enable chat");
              $sender->sendMessage(TF::YELLOW."/xchat disable".TF::GRAY." - Disable chat");
              $sender->sendMessage(TF::YELLOW."/xchat mute <player>".TF::GRAY." - Mute player");
              $sender->sendMessage(TF::YELLOW."/xchat unmute <player>".TF::GRAY." - Unmute player");
              $sender->sendMessage(TF::GRAY."Showing page ".TF::YELLOW."1".TF::GRAY." of ".TF::YELLOW."1");
              return true;
            }
            else {
              $sender->sendMessage($this->betterColors("&", "&c".$np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "enable"){
            if($sender->hasPermission("xchat.enable") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $ecmsg = $this->getConfig()->get("enable-chat-message");
              $ecbc = $this->getConfig()->get("enable-chat-broadcast");
              $ecbc = str_replace("{PLAYER}", $sender->getName(), $ecbc);
              $this->getConfig()->set("chat","enabled");
              $this->getConfig()->save();
              $sender->sendMessage($this->betterColors("&", "&e".$ecmsg));
              $this->getServer()->broadcastMessage($this->betterColors("&", "&7".$ecbc));
              return true;
            }
            else {
              $sender->sendMessage($this->betterColors("&", "&c".$np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "disable"){
            if($sender->hasPermission("xchat.disable") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $dcmsg = $this->getConfig()->get("disable-chat-message");
              $dcbc = $this->getConfig()->get("disable-chat-broadcast");
              $dcbc = str_replace("{PLAYER}", $sender->getName(), $dcbc);
              $this->getConfig()->set("chat","disabled");
              $this->getConfig()->save();
              $sender->sendMessage($this->betterColors("&", "&e".$dcmsg));
              $this->getServer()->broadcastMessage($this->betterColors("&", "&7".$dcbc));
              return true;
            }
            else {
              $sender->sendMessage($this->betterColors("&", "&c".$np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "reload"){
            if($sender->hasPermission("xchat.reload") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $this->reloadConfig();
              $sender->sendMessage(TF::YELLOW."[xChat]".TF::GRAY." Configuration file has been reloaded!");
              return true;
            }
            else {
              $sender->sendMessage($this->betterColors("&", "&c".$np));
              return true;
             }
           }
           elseif(strtolower($args[0]) == "mute"){
             if($sender->hasPermission("xchat.mute") || $sender->hasPermission("xchat.*") || $sender->isOp()){
               if(!isset($args[1])){
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /chat mute <player>");
                 return true;
               }
                 if(isset($args[1])){
                 $name = $args[1];
                 $target = $this->getServer()->getPlayerExact($name);
                 if($target instanceof Player){
                   $mmsg = $this->getConfig()->get("mute-message");
                   $mmsg = str_replace("{PLAYER}", $target->getName(), $mmsg);
                   $mpmsg = $this->getConfig()->get("player-mute-message");
                   $mpmsg = str_replace("{PLAYER}", $sender->getName(), $mpmsg);
                   $this->playersMuted->set(strtolower($args[1]));
                   $this->playersMuted->save();
                   $sender->sendMessage($this->betterColors("&", "&e".$mmsg));
                   $target->sendMessage($this->betterColors("&", "&7".$mpmsg));
                   return true;
                 }
                 else {
                   $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Invalid player provided!");
                   return true;
                 }
             }
             else {
               $sender->sendMessage($this->betterColors("&", "&c".$np));
               return true;
             }
           }
           }
           elseif(strtolower($args[0]) == "unmute"){
             if($sender->hasPermission("xchat.unmute") || $sender->hasPermission("xchat.*") || $sender->isOp()){
               if(!isset($args[1])){
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /chat unmute <player>");
                 return true;
               }
                 if(isset($args[1])){
                 $name = $args[1];
                 $target = $this->getServer()->getPlayerExact($name);
                 if($target instanceof Player){
                   $umsg = $this->getConfig()->get("unmute-message");
                   $umsg = str_replace("{PLAYER}", $target->getName(), $umsg);
                   $upmsg = $this->getConfig()->get("player-unmute-message");
                   $upmsg = str_replace("{PLAYER}", $sender->getName(), $upmsg);
                   $this->playersMuted->remove(strtolower($args[1]));
                   $this->playersMuted->save();
                   $sender->sendMessage($this->betterColors("&", "&e".$umsg));
                   $target->sendMessage($this->betterColors("&", "&7".$upmsg));
                   return true;
                 }
                 else {
                   $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Invalid player provided!");
                   return true;
                 }
             }
             else {
               $sender->sendMessage($this->betterColors("&", "&c".$np));
               return true;
             }
           }
         }
         }
         else {
           $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /xchat <arg1> <arg2>");
           return true;
       }
     }
   }
     
  public function onChat(PlayerChatEvent $event){
    $player = $event->getPlayer();
    $pdcmsg = $this->getConfig()->get("chat-disabled-message");
    $pmmsg = $this->getConfig()->get("muted-player-message");
    if($this->getConfig()->getAll()["chat"] == "disabled"){
      $event->setCancelled(true);
      $player->sendMessage($this->betterColors("&", "&e".$pdcmsg));
      return true;
    }
    else {
      if($this->playersMuted->exists(strtolower($event->getPlayer()->getName()))){
        $event->setCancelled(true);
        $player->sendMessage($this->betterColors("&", "&c".$pmmsg));
        return true;
      }
      else {
        return false;
      }
    }
  }
}
