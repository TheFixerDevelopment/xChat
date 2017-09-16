<?php
namespace Rysieeku\xChat;

/*
* xChat 1.5
* Author: Rysieeku
* API: 3.0.0-ALPHA6
*/

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

  /** @var Config $bannedWords */
  private $bannedWords;
  /** @var Config $lang */
  public $lang;
  
  public function translateColors(string $msg) {
    return str_replace("&", "§", $msg);
  }
  
  public function onEnable() {
  	$this->saveDefaultConfig();
  	$this->bannedWords = new Config($this->getDataFolder() . "words.txt", Config::ENUM);
  	$this->saveResource("language.yml");
  	$this->lang = new Config($this->getDataFolder() . "language.yml", Config::YAML);
  	if(!is_dir($this->getDataFolder()."muted_players")) {
  	  mkdir($this->getDataFolder()."muted_players");
    }
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(TF::BOLD.TF::GREEN."xChat".TF::RESET.TF::YELLOW." by Rysieeku has been loaded!");
  }
  
  public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
    $np = $this->lang->get("no-permission");
    switch(strtolower($command->getName())) {
      case "xchat":
        if(isset($args[0])) {
          if(strtolower($args[0]) == "clear") {
            if($sender->hasPermission("xchat.clear") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
              $msg = $this->lang->get("clear-broadcast");
              $msg = str_replace("{PLAYER}", $sender->getName(), $msg);
              $pmsg = $this->lang->get("clear-message-player");
              $this->getServer()->broadcastMessage(str_repeat("\n", 20));
              $this->getServer()->broadcastMessage($this->translateColors($msg));
              $sender->sendMessage($this->translateColors($pmsg));
              return true;
            }
            else {
              $sender->sendMessage($this->translateColors($np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "info") {
            if($sender->hasPermission("xchat.info") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
              $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Info".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
              $sender->sendMessage(TF::GRAY."Author -".TF::YELLOW." Rysieeku");
              $sender->sendMessage(TF::GRAY."Version - ".TF::YELLOW.$this->getDescription()->getVersion());
              $sender->sendMessage(TF::GRAY."E-mail -".TF::YELLOW." rysieeku@upblock.pl");
              return true;
            }
            else {
              $sender->sendMessage($this->translateColors($np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "help") {
            if($sender->hasPermission("xchat.help") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
              if(!isset($args[1])) {
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
              if(strtolower($args[1]) == "1") {
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
              elseif(strtolower($args[1]) == "2") {
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
              $sender->sendMessage($this->translateColors($np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "enable") {
            if($sender->hasPermission("xchat.enable") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
              if($this->getConfig()->getAll()["chat"] == "enabled") {
                $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Chat is already enabled!");
                return true;
              }
              else {
                $ecmsg = $this->lang->get("enable-chat-message");
                $ecbc = $this->lang->get("enable-chat-broadcast");
                $ecbc = str_replace("{PLAYER}", $sender->getName(), $ecbc);
                $this->getConfig()->set("chat","enabled");
                $this->getConfig()->save();
                $sender->sendMessage($this->translateColors($ecmsg));
                $this->getServer()->broadcastMessage($this->translateColors($ecbc));
                return true;
              }
            }
            else {
              $sender->sendMessage($this->translateColors($np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "disable") {
            if($sender->hasPermission("xchat.disable") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
              if($this->getConfig()->getAll()["chat"] == "disabled") {
                $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Chat is already disabled!");
                return true;
              }
              else {
                $dcmsg = $this->lang->get("disable-chat-message");
                $dcbc = $this->lang->get("disable-chat-broadcast");
                $dcbc = str_replace("{PLAYER}", $sender->getName(), $dcbc);
                $this->getConfig()->set("chat","disabled");
                $this->getConfig()->save();
                $sender->sendMessage($this->translateColors($dcmsg));
                $this->getServer()->broadcastMessage($this->translateColors($dcbc));
                return true;
              }
            }
            else {
              $sender->sendMessage($this->translateColors($np));
              return true;
            }
          }
          elseif(strtolower($args[0]) == "reload") {
            if($sender->hasPermission("xchat.reload") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
              $this->reloadConfig();
              $sender->sendMessage(TF::YELLOW."[xChat]".TF::GRAY." Configuration file has been reloaded!");
              return true;
            }
            else {
              $sender->sendMessage($this->translateColors($np));
              return true;
             }
           }
           elseif(strtolower($args[0]) == "words") {
             if($sender->hasPermission("xchat.words") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
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
               $sender->sendMessage($this->translateColors($np));
               return true;
               }
           }
           elseif(strtolower($args[0]) == "remove") {
             if($sender->hasPermission("xchat.remove") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
               if(!isset($args[1])) {
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /chat remove <word>");
                 return true;
               }
                 if(isset($args[1])) {
                   if(!$this->bannedWords->exists(strtolower($args[1]))) {
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
               $sender->sendMessage($this->translateColors($np));
               return true;
               }
           }
           elseif(strtolower($args[0]) == "add") {
             if($sender->hasPermission("xchat.add") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
               if(!isset($args[1])) {
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /chat add <word>");
                 return true;
               }
                 if(isset($args[1])) {
                   if($this->bannedWords->exists(strtolower($args[1]))) {
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
               $sender->sendMessage($this->translateColors($np));
               return true;
               }
           }
           elseif(strtolower($args[0]) == "muted") {
             if($sender->hasPermission("xchat.muted") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
               $sender->sendMessage(TF::GRAY."-=[ ".TF::GREEN."+".TF::GRAY." ] [ ".TF::YELLOW."Muted Players".TF::GRAY." ] [ ".TF::GREEN."+".TF::GRAY." ]=-");
               if(count(glob($this->getDataFolder()."muted_players/*")) === 0) {
                 $sender->sendMessage(TF::GRAY."No muted players!");
                 return true;
               }
               else {
                 foreach(glob($this->getDataFolder()."muted_players/*") as $muted) {
                   $mutedfor = file_get_contents($muted);
                   if($mutedfor == "permanent") {
                     $sender->sendMessage(TF::YELLOW.basename($muted, ".yml").TF::GRAY." - ".TF::YELLOW."Permanent");
                   }
                   else {
                     $sender->sendMessage(TF::YELLOW.basename($muted, ".yml").TF::GRAY." until ".TF::YELLOW.$mutedfor);
                   }
                 }
               }
             }
             else {
               $sender->sendMessage($this->translateColors($np));
               return true;
               }
           }
           elseif(strtolower($args[0]) == "timemute") {
             if($sender->hasPermission("xchat.timemute") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
               if(!isset($args[1]) || !isset($args[2])) {
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /chat timemute <player> <time>");
                 return true;
               }
                 if(isset($args[1]) && isset($args[2])) {
                 $time = intval($args[2]);
                 $timename = $args[1];
                 $timetarget = $this->getServer()->getPlayerExact($timename);
                   if($timetarget instanceof Player) {
                     if($timetarget->hasPermission("xchat.bypass") || $timetarget->hasPermission("xchat.*") || $timetarget->isOp()) {
                       $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." This player can't be muted!");
                       return true;
                     }
                     else {
                       if(file_exists($this->getDataFolder()."muted_players/".strtolower($timetarget->getName()).".yml")) {
                         $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." This player is already muted!");
                         return true;
                       }
                       else {
                         $tmmsg = $this->lang->get("time-mute-message");
                         $tmmsg = str_replace("{PLAYER}", $timetarget->getName(), $tmmsg);
                         $tmmsg = str_replace("{TIME}", $time, $tmmsg);
                         $ptmmsg = $this->lang->get("player-time-mute");
                         $ptmmsg = str_replace("{PLAYER}", $sender->getName(), $ptmmsg);
                         $ptmmsg = str_replace("{TIME}", $time, $ptmmsg);
                         $df = $this->getConfig()->get("datetime-format");
                         if($time > 0) {
                           file_put_contents($this->getDataFolder()."muted_players/".strtolower($timetarget->getName()).".yml", date($df, strtotime("$time minutes")));
                           $this->getServer()->getScheduler()->scheduleDelayedTask(new UnmutePlayerTask($this, $timetarget), $time * 20 * 60);
                           $sender->sendMessage($this->translateColors($tmmsg));
                           $timetarget->sendMessage($this->translateColors($ptmmsg));
                           return true;
                         }
                         else {
                           $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Invalid mute time!");
                           return true;
                         }
                       }
                     }
                   }
                   else {
                     $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Invalid player provided!");
                     return true;
                   }
                 }
               }
               else {
                 $sender->sendMessage($this->translateColors($np));
                 return true;
               }
             }
           elseif(strtolower($args[0]) == "mute") {
             if($sender->hasPermission("xchat.mute") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
               if(!isset($args[1])) {
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /chat mute <player>");
                 return true;
               }
                 if(isset($args[1])) {
                 $name = $args[1];
                 $target = $this->getServer()->getPlayerExact($name);
                 if($target instanceof Player) {
                   if($target->hasPermission("xchat.bypass") || $target->hasPermission("xchat.*") || $target->isOp()){
                     $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." This player can't be muted!");
                     return true;
                   }
                   else {
                     if(file_exists($this->getDataFolder()."muted_players/".strtolower($target->getName()).".yml")) {
                       $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." This player is already muted!");
                       return true;
                     }
                     else {
                       $mmsg = $this->lang->get("mute-message");
                       $mmsg = str_replace("{PLAYER}", $target->getName(), $mmsg);
                       $mpmsg = $this->lang->get("player-mute-message");
                       $mpmsg = str_replace("{PLAYER}", $sender->getName(), $mpmsg);
                       file_put_contents($this->getDataFolder()."muted_players/".strtolower($target->getName()).".yml", "permanent");
                       $sender->sendMessage($this->translateColors($mmsg));
                       $target->sendMessage($this->translateColors($mpmsg));
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
               $sender->sendMessage($this->translateColors($np));
               return true;
               }
             }
           }
           elseif(strtolower($args[0]) == "unmuteall") {
             if($sender->hasPermission("xchat.unmuteall") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
               if(count(glob($this->getDataFolder()."muted_players/*")) === 0) {
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." There are no muted players!");
                 return true;
               }
               else {
                 $uall = $this->lang->get("unmute-all-message");
                 $files = glob($this->getDataFolder()."muted_players/*");
                 foreach($files as $file) {
                   if(file_exists($file)) {
                     unlink($file);
                   }
                 }
                 $sender->sendMessage($this->translateColors($uall));
                 return true;
               }
             }
             else {
               $sender->sendMessage($this->translateColors($np));
               return true;
             }
           }
           elseif(strtolower($args[0]) == "unmute") {
             if($sender->hasPermission("xchat.unmute") || $sender->hasPermission("xchat.*") || $sender->isOp()) {
               if(!isset($args[1])) {
                 $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Usage: /chat unmute <player>");
                 return true;
               }
                 if(isset($args[1])) {
                 $name = $args[1];
                 $target = $this->getServer()->getPlayerExact($name);
                 if($target instanceof Player){
                   if(!file_exists($this->getDataFolder()."muted_players/".strtolower($target->getName()).".yml")) {
                     $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." This player is not muted!");
                     return true;
                   }
                   else {
                     $umsg = $this->lang->get("unmute-message");
                     $umsg = str_replace("{PLAYER}", $target->getName(), $umsg);
                     $upmsg = $this->lang->get("player-unmute-message");
                     $upmsg = str_replace("{PLAYER}", $sender->getName(), $upmsg);
                     unlink($this->getDataFolder()."muted_players/".strtolower($target->getName()).".yml");
                     $sender->sendMessage($this->translateColors($umsg));
                     $target->sendMessage($this->translateColors($upmsg));
                     return true;
                   }
                 }
                 else {
                   $sender->sendMessage(TF::YELLOW."[xChat]".TF::RED." Invalid player provided!");
                   return true;
                 }
             }
             else {
               $sender->sendMessage($this->translateColors($np));
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
     
  public function onChat(PlayerChatEvent $event) {
    $message = $event->getMessage();
    $player = $event->getPlayer();
    $pdcmsg = $this->lang->get("chat-disabled");
    $pmmsg = $this->lang->get("player-muted");
    $bwmsg = $this->lang->get("banned-word-message");
    $bwk = $this->lang->get("banned-word-kick");
    if($this->getConfig()->getAll()["chat"] == "disabled") {
      if($player->hasPermission("xchat.bypass") || $player->hasPermission("xchat.*") || $player->isOp()) {
        return;
      }
      else {
        $event->setCancelled(true);
        $player->sendMessage($this->translateColors($pdcmsg));
        return;
      }
    }
    else {
      if(file_exists($this->getDataFolder()."muted_players/".strtolower($player->getName()).".yml")) {
        $event->setCancelled(true);
        $player->sendMessage($this->translateColors($pmmsg));
        return;
      }
      else {
        foreach($this->bannedWords->getAll(true) as $bannedword) {
          $containwords = stripos($message, $bannedword);
          if($containwords !== false){
            if($player->hasPermission("xchat.bypass") || $player->hasPermission("xchat.*") || $player->isOp()) {
            }
            else {
              $event->setCancelled(true);
                if($this->getConfig()->getAll()["bad-words"] == "kick") {
                  $player->kick($this->translateColors($bwk));
              }
              elseif($this->getConfig()->getAll()["bad-words"] == "message") {
                $player->sendMessage($this->translateColors($bwmsg));
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
