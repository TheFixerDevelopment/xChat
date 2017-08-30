<?php
namespace Rysieeku\xChat;

/*
* xChat 1.4
* Author: Rysieeku
* API: 3.0.0-ALPHA7
*/

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

  /** @var Config $playersMuted */
  private $playersMuted;
  /** @var Config $bannedWords */
  private $bannedWords;
  
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
  
  public function onEnable(){
  	$this->saveDefaultConfig();
  	$this->playersMuted = new Config($this->getDataFolder() . "muted.txt", Config::ENUM);
  	$this->bannedWords = new Config($this->getDataFolder() . "words.txt", Config::ENUM);
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(TF::BOLD.TF::GREEN."xChat".TF::RESET.TF::GREEN." by Rysieeku has been loaded!");
  }
  
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
    $np = $this->getConfig()->get("no-permission");
    switch(strtolower($command->getName())){
      case "xchat":
        if(isset($args[0])){
          if(strtolower($args[0]) == "clear"){
            if($sender->hasPermission("xchat.clear") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $msg = $this->getConfig()->get("clear-message");
              $msg = str_replace("{PLAYER}", $sender->getName(), $msg);
              $pmsg = $this->getConfig()->get("clear-message-player");
              $this->getServer()->broadcastMessage("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nn\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
              $this->getServer()->broadcastMessage($this->betterColors("&", $msg));
              $sender->sendMessage($this->betterColors("&", $pmsg));
              return true;
            }
            else {
              $sender->sendMessage($this->betterColors("&", $np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "info"){
            if($sender->hasPermission("xchat.info") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Info".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
              $sender->sendMessage(TF::GRAY."Author -".TF::YELLOW." Rysieeku");
              $sender->sendMessage(TF::GRAY."Version - ".TF::YELLOW.$this->getDescription()->getVersion());
              $sender->sendMessage(TF::GRAY."E-mail -".TF::YELLOW." rysieeku@upblock.pl");
              return true;
            }
            else {
              $sender->sendMessage($this->betterColors("&", $np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "help"){
            if($sender->hasPermission("xchat.help") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              if(!isset($args[1])){
                $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Available commands".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
                $sender->sendMessage(TF::YELLOW."/xchat help".TF::GRAY." - Available commands");
                $sender->sendMessage(TF::YELLOW."/xchat info".TF::GRAY." - Info about plugin");
                $sender->sendMessage(TF::YELLOW."/xchat clear".TF::GRAY." - Clear chat");
                $sender->sendMessage(TF::YELLOW."/xchat reload".TF::GRAY." - Reload config file");
                $sender->sendMessage(TF::YELLOW."/xchat enable".TF::GRAY." - Enable chat");
                $sender->sendMessage(TF::YELLOW."/xchat disable".TF::GRAY." - Disable chat");
                $sender->sendMessage(TF::YELLOW."/xchat mute <player>".TF::GRAY." - Mute player");
                $sender->sendMessage(TF::YELLOW."/xchat unmute <player>".TF::GRAY." - Unmute player");
                $sender->sendMessage(TF::GRAY."Showing page ".TF::YELLOW."1".TF::GRAY." of ".TF::YELLOW."2");
                return true;
              }
              if(strtolower($args[1]) == "1"){
                  $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Available commands".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
                  $sender->sendMessage(TF::YELLOW."/xchat help".TF::GRAY." - Available commands");
                  $sender->sendMessage(TF::YELLOW."/xchat info".TF::GRAY." - Info about plugin");
                  $sender->sendMessage(TF::YELLOW."/xchat clear".TF::GRAY." - Clear chat");
                  $sender->sendMessage(TF::YELLOW."/xchat reload".TF::GRAY." - Reload config file");
                  $sender->sendMessage(TF::YELLOW."/xchat enable".TF::GRAY." - Enable chat");
                  $sender->sendMessage(TF::YELLOW."/xchat disable".TF::GRAY." - Disable chat");
                  $sender->sendMessage(TF::YELLOW."/xchat mute <player>".TF::GRAY." - Mute player");
                  $sender->sendMessage(TF::YELLOW."/xchat unmute <player>".TF::GRAY." - Unmute player");
                  $sender->sendMessage(TF::GRAY."Showing page ".TF::YELLOW."1".TF::GRAY." of ".TF::YELLOW."2");
                  return true;
              }
              elseif(strtolower($args[1]) == "2"){
                $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Available commands".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
                $sender->sendMessage(TF::YELLOW."/xchat add <word>".TF::GRAY." - Add new banned word");
                $sender->sendMessage(TF::YELLOW."/xchat remove <word>".TF::GRAY." - Remove banned word");
                $sender->sendMessage(TF::YELLOW."/xchat muted".TF::GRAY." - Check muted players");
                $sender->sendMessage(TF::YELLOW."/xchat words".TF::GRAY." - Check banned words");
                $sender->sendMessage(TF::GRAY."Showing page ".TF::YELLOW."2".TF::GRAY." of ".TF::YELLOW."2");
                return true;
              }
              else {
                $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Unknown command!");
                return true;
              }
            }
            else {
              $sender->sendMessage($this->betterColors("&", $np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "enable"){
            if($sender->hasPermission("xchat.enable") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              if($this->getConfig()->getAll()["chat"] == "enabled"){
                $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Chat is already enabled!");
                return true;
              }
              else {
                $ecmsg = $this->getConfig()->get("enable-chat-message");
                $ecbc = $this->getConfig()->get("enable-chat-broadcast");
                $ecbc = str_replace("{PLAYER}", $sender->getName(), $ecbc);
                $this->getConfig()->set("chat","enabled");
                $this->getConfig()->save();
                $sender->sendMessage($this->betterColors("&", $ecmsg));
                $this->getServer()->broadcastMessage($this->betterColors("&", $ecbc));
                return true;
              }
            }
            else {
              $sender->sendMessage($this->betterColors("&", $np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "disable"){
            if($sender->hasPermission("xchat.disable") || $sender->hasPermission("xchat.*") || $sender->isOp()){
              if($this->getConfig()->getAll()["chat"] == "disabled"){
                $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Chat is already disabled!");
                return true;
              }
              else {
                $dcmsg = $this->getConfig()->get("disable-chat-message");
                $dcbc = $this->getConfig()->get("disable-chat-broadcast");
                $dcbc = str_replace("{PLAYER}", $sender->getName(), $dcbc);
                $this->getConfig()->set("chat","disabled");
                $this->getConfig()->save();
                $sender->sendMessage($this->betterColors("&", $dcmsg));
                $this->getServer()->broadcastMessage($this->betterColors("&", $dcbc));
                return true;
              }
            }
            else {
              $sender->sendMessage($this->betterColors("&", $np));
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
              $sender->sendMessage($this->betterColors("&", $np));
              return true;
             }
           }
           elseif(strtolower($args[0]) == "words"){
             if($sender->hasPermission("xchat.words") || $sender->hasPermission("xchat.*") || $sender->isOp()){
               $words = $this->bannedWords->getAll(true);
               $bwords = implode(", ", $words);
               $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Banned Words".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
               if(filesize($this->getDataFolder() . "words.txt") == 0){
                 $sender->sendMessage(TF::GRAY."No blacklisted words!");
                 return true;
               }
               else {
                 $sender->sendMessage(TF::GRAY.$bwords);
                 return true;
               }
             }
             else {
               $sender->sendMessage($this->betterColors("&", $np));
               return true;
               }
           }
           elseif(strtolower($args[0]) == "remove"){
             if($sender->hasPermission("xchat.remove") || $sender->hasPermission("xchat.*") || $sender->isOp()){
               if(!isset($args[1])){
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /chat remove <word>");
                 return true;
               }
                 if(isset($args[1])){
                   if(!$this->bannedWords->exists(strtolower($args[1]))){
                     $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Word ".TF::YELLOW.$args[1].TF::RED." does not exists!");
                     return true;
                   }
                   else {
                     $this->bannedWords->remove(strtolower($args[1]));
                     $this->bannedWords->save();
                     $sender->sendMessage(TF::YELLOW."[xChat]".TF::GRAY." Word ".TF::YELLOW.$args[1].TF::GRAY." has been removed!");
                     return true;
                 }
               }
             }
             else {
               $sender->sendMessage($this->betterColors("&", $np));
               return true;
               }
           }
           elseif(strtolower($args[0]) == "add"){
             if($sender->hasPermission("xchat.add") || $sender->hasPermission("xchat.*") || $sender->isOp()){
               if(!isset($args[1])){
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /chat add <word>");
                 return true;
               }
                 if(isset($args[1])){
                   if($this->bannedWords->exists(strtolower($args[1]))){
                     $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Word ".TF::YELLOW.$args[1].TF::RED." already exists!");
                     return true;
                   }
                   else {
                     $this->bannedWords->set(strtolower($args[1]));
                     $this->bannedWords->save();
                     $sender->sendMessage(TF::YELLOW."[xChat]".TF::GRAY." Word ".TF::YELLOW.$args[1].TF::GRAY." has been added!");
                     return true;
                 }
               }
             }
             else {
               $sender->sendMessage($this->betterColors("&", $np));
               return true;
               }
           }
           elseif(strtolower($args[0]) == "muted"){
             if($sender->hasPermission("xchat.muted") || $sender->hasPermission("xchat.*") || $sender->isOp()){
               $mutedget = $this->playersMuted->getAll(true);
               $mutedlist = implode(", ", $mutedget);
               $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Muted Players".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
               if(filesize($this->getDataFolder() . "muted.txt") == 0){
                 $sender->sendMessage(TF::GRAY."No muted players!");
                 return true;
               }
               else {
                 $sender->sendMessage(TF::GRAY.$mutedlist);
                 return true;
               }
             }
             else {
               $sender->sendMessage($this->betterColors("&", $np));
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
                   if($target->hasPermission("xchat.bypass") || $target->hasPermission("xchat.*") || $target->isOp()){
                     $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." This player can't be muted!");
                     return true;
                   }
                   else {
                     if($this->playersMuted->exists(strtolower($target->getName()))){
                       $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." This player is already muted!");
                       return true;
                     }
                     else {
                       $mmsg = $this->getConfig()->get("mute-message");
                       $mmsg = str_replace("{PLAYER}", $target->getName(), $mmsg);
                       $mpmsg = $this->getConfig()->get("player-mute-message");
                       $mpmsg = str_replace("{PLAYER}", $sender->getName(), $mpmsg);
                       $this->playersMuted->set(strtolower($args[1]));
                       $this->playersMuted->save();
                       $sender->sendMessage($this->betterColors("&", $mmsg));
                       $target->sendMessage($this->betterColors("&", $mpmsg));
                       return true;
                     }
                   }
                 }
                 else {
                   $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Invalid player provided!");
                   return true;
                 }
             }
             else {
               $sender->sendMessage($this->betterColors("&", $np));
               return true;
               }
             }
           }
           elseif(strtolower($args[0]) == "unmuteall"){
             if($sender->hasPermission("xchat.unmuteall") || $sender->hasPermission("xchat.*") || $sender->isOp()){
               if(filesize($this->getDataFolder() . "muted.txt") == 0){
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." There are no muted players!");
                 return true;
               }
               else {
                 unlink($this->getDataFolder() . "muted.txt");
                 $this->playersMuted = new Config($this->getDataFolder() . "muted.txt", Config::ENUM);
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::GRAY." All players have been unmuted!");
                 return true;
               }
             }
             else {
               $sender->sendMessage($this->betterColors("&", $np));
               return true;
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
                   if(!$this->playersMuted->exists(strtolower($target->getName()))){
                     $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." This player is not muted!");
                     return true;
                   }
                   else {
                     $umsg = $this->getConfig()->get("unmute-message");
                     $umsg = str_replace("{PLAYER}", $target->getName(), $umsg);
                     $upmsg = $this->getConfig()->get("player-unmute-message");
                     $upmsg = str_replace("{PLAYER}", $sender->getName(), $upmsg);
                     $this->playersMuted->remove(strtolower($args[1]));
                     $this->playersMuted->save();
                     $sender->sendMessage($this->betterColors("&", $umsg));
                     $target->sendMessage($this->betterColors("&", $upmsg));
                     return true;
                   }
                 }
                 else {
                   $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Invalid player provided!");
                   return true;
                 }
             }
             else {
               $sender->sendMessage($this->betterColors("&", $np));
               return true;
               }
             }
           }
           else {
             $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Unknown command!");
             return true;
           }
         }
         else {
           $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /xchat <arg1> <arg2>");
           return true;
         }
       }
       return true;
     }
     
  public function onChat(PlayerChatEvent $event){
    $message = $event->getMessage();
    $player = $event->getPlayer();
    $pdcmsg = $this->getConfig()->get("chat-disabled-message");
    $pmmsg = $this->getConfig()->get("muted-player-message");
    $bwmsg = $this->getConfig()->get("banned-word-message");
    $bwk = $this->getConfig()->get("banned-word-kick");
    if($this->getConfig()->getAll()["chat"] == "disabled"){
      if($player->hasPermission("xchat.bypass") || $player->hasPermission("xchat.*") || $player->isOp()){
        return;
      }
      else {
        $event->setCancelled(true);
        $player->sendMessage($this->betterColors("&", $pdcmsg));
        return;
      }
    }
    else {
      if($this->playersMuted->exists(strtolower($event->getPlayer()->getName()))){
        $event->setCancelled(true);
        $player->sendMessage($this->betterColors("&", $pmmsg));
        return;
      }
      else {
        foreach($this->bannedWords->getAll(true) as $bannedword){
          $containwords = stripos($message, $bannedword);
          if($containwords !== false){
            if($player->hasPermission("xchat.bypass") || $player->hasPermission("xchat.*") || $player->isOp()){
            }
            else {
              $event->setCancelled(true);
                if($this->getConfig()->getAll()["bad-words"] == "kick"){
                  $player->kick($this->betterColors("&", $bwk));
              }
              elseif($this->getConfig()->getAll()["bad-words"] == "message"){
                $player->sendMessage($this->betterColors("&", $bwmsg));
              }
              else {
              }
            }
          }
          else {
          }
        }
      }
    }
  }
}
