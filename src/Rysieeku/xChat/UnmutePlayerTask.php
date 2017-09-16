<?php
namespace Rysieeku\xChat;

use pocketmine\scheduler\PluginTask;
use pocketmine\utils\Config;
use pocketmine\Player;

class UnmutePlayerTask extends PluginTask {

  private $timetarget;
  public function __construct(Main $plugin, Player $timetarget) {
    parent::__construct($plugin);
    $this->plugin = $plugin;
    $this->timetarget = $timetarget;
  }
  
  public function onRun(int $currentTick) {
    $tum = $this->plugin->lang->get("time-unmute-message");
    if(file_exists($this->plugin->getDataFolder()."muted_players/".strtolower($this->timetarget->getName()).".yml")) {
      if($this->timetarget instanceof Player && !$this->timetarget->isClosed()) {
        $this->timetarget->sendMessage($this->plugin->translateColors($tum));
        unlink($this->plugin->getDataFolder()."muted_players/".strtolower($this->timetarget->getName()).".yml");
      }
      else {
        unlink($this->plugin->getDataFolder()."muted_players/".strtolower($this->timetarget->getName()).".yml");
      }
    }
    else {
      return false;
    }
  }
}
