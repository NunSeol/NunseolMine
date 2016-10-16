<?php

namespace nunseol;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\Server;
use pocketmine\Player;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;

class NunseolMine extends PluginBase implements Listener{
	
	private $money;
	private $moneyr;
	private $i1;
	private $i2;
	private $i3;
	
   public function onEnable() {
   	$this->loadConfig();
      $this->economy = EconomyAPI::getInstance ();
      $this->config = new Config ( $this->getDataFolder(). "config.yml", Config::YAML);
      $this->getServer ()->getPluginManager ()->registerEvents( $this, $this );
      $this->getLogger ()->info ( "§6[ 광질 ] 커맨드 광산 플러그인이 로드되었다냥!" );
   }
   public function loadConfig() {
   	@mkdir ( $this->getDataFolder());
       $this->saveDefaultConfig();
       $this->money = $this->getConfig()->get("money-amount", "");
       $this->moneyr = $this->getConfig()->get("money-remove-amount", "");
       $this->i1 = $this->getConfig()->get("item-id", "");
       $this->i2 = $this->getConfig()->get("item-damage", "");
       $this->i3 = $this->getConfig()->get("item-amount", "");
   }
   public function onDisable() {
      $this->getLogger ()->info ( "§6[ 광질 ] 플러그인 비활성화다냥!" );
   }
   public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
      if($command->getName() == "광질") {
         switch (mt_rand(1, 2)) {
            case 1:
            $this->economy->addMoney ( $sender, $this->money );
            $sender->sendMessage ( "§6[ 광질 ] 광질을 하여 돈을 벌었습니다!" );
            break;
            case 2:
            $this->economy->reduceMoney ( $sender, $this->moneyr );
            $sender->sendMessage ( "§6[ 광질 ] 광질을 하던도중 돈을 잃었습니다아!." );
            break;
        }
    }
            
            if($command->getName() == "아이템광질") {
            	switch (mt_rand(1, 2)) {
            	case "1":
            	$sender->getInventory ()->addItem ( Item::get ( $this->i1, $this->i2, $this->i3 ) );
            	$sender->sendMessage ( "§6[ 아이템광질 ] 아이템 획득!" );
            	break;
            	case "2":
            	$sender->getInventory ()->addItem ( Item::get ( 60, 0, 5) );
            	$sender->sendMessage ( "§6[ 아이템광질 ] 농토5개 획득!" );
            	break;
            }
        }
    }
}