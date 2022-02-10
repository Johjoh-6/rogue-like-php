<?php

require 'class/player.php';

class Game extends Player{
    public $map = [];
    public $playerMap = [];
    protected $key = 'k';
    protected $start = 's';
    protected $end = 'e';
    public $player;
    protected $finish = false; 
   
    function __construct($mapFill){
        $this->map = $mapFill;
        $this->playerMap = $mapFill;
        $this->player = new Player('p');
    }
    public function init(){
        return $this->map;
    }
    public function showMap($selectMap){
        for ($column = 0; $column <= count($selectMap[0]); $column++){
            echo " - ";
        }
        echo "\n";
        for($line = 0; $line < count($selectMap); $line++){
            echo "| ";
            for($cell = 0; $cell < count($selectMap[$line]); $cell++){
                echo " ";
                echo $selectMap[$line][$cell];
                echo " ";
            }
            echo " | \n";
        }
        for ($column = 0; $column <= count($selectMap[0]); $column++){
            echo " - ";
        }
        echo "\n";
    }
    public function getMap(){
        return $this->map;
    }
    public function getPlayerMap(){
        return $this->playerMap;
    }
    public function getInfoMap($x, $y){
        if(is_numeric($x) && is_numeric($y)){
            return $this->map[$x][$y];
        }
    }
    public function getFinish(){
        return $this->finish;
    }
    public function setMapId($x, $y, $info){
        if(is_numeric($x) && is_numeric($y)){
            return $this->map[$x][$y] = $info;
        }
    }
    public function setMapPlayer($x, $y, $symbol){
            return $this->playerMap[$x][$y] = $symbol;
    }
    private function setFinish($value){
        return $this->finish = $value;
    }
    public function checkDest($x, $y){
        if(isset($this->getMap()[$x][$y])){
            if($this->getMap()[$x][$y] !== 1){
                echo "not a wall \n";
            return true;
            } else {
                echo "Wall \n";
                return false;
            }
        }
        else {
            echo "Outside gameboard \n";
            return false;
        }
    }

    public function movePlayer($key){
        $x = $this->player->getPlayerPos()[0];
        $y = $this->player->getPlayerPos()[1];
          switch ($key) {
            case "w":
                echo "UP ";
              if($this->checkDest(($x - 1), $y)){
                $this->cleanMap();
                  $this->player->setPlayerPos([($x - 1), $y]);
                  $this->setMapPlayer(($x - 1), $y, $this->player->getSymbol());
                  $this->getKey();
                  $this->endGame();
              } 
              break;
              case "s":
                echo "DOWN ";
                if($this->checkDest(($x + 1), $y)){
                    $this->cleanMap();
                    $this->player->setPlayerPos([($x + 1), $y]);
                    $this->setMapPlayer(($x + 1), $y, $this->player->getSymbol());
                    $this->getKey();
                    $this->endGame();
                } 
              break;
              case "d":
                echo  "RIGHT ";
                if($this->checkDest($x, ($y + 1))){
                    $this->cleanMap();
                    $this->player->setPlayerPos([$x, ($y + 1)]);
                    $this->setMapPlayer($x, ($y + 1), $this->player->getSymbol());
                    $this->getKey();
                    $this->endGame();
                } 
              break;
              case "a":
                echo "LEFT ";
                if($this->checkDest($x, ($y -1))){
                    $this->cleanMap();
                    $this->player->setPlayerPos([$x, ($y - 1)]);
                    $this->setMapPlayer($x, ($y -1), $this->player->getSymbol());
                    $this->getKey();
                    $this->endGame();
                } 
              break;
            
        }
    }
    private function cleanMap(){
        $x = $this->player->getPlayerPos()[0];
        $y = $this->player->getPlayerPos()[1];
        $cell = $this->getMap()[$x][$y];
        if($cell === $this->start || $cell === $this->key){
            $this->map[$x][$y] = 0;
        }
        return $this->playerMap = $this->map;
    }
    private function getKey(){
        $x = $this->player->getPlayerPos()[0];
        $y = $this->player->getPlayerPos()[1];
        $cell = $this->getMap()[$x][$y];
        if($cell === $this->key){
            echo "You find a key ! \n";
            return $this->player->setPocket("key");
        }
    }
    private function endGame(){
        $x = $this->player->getPlayerPos()[0];
        $y = $this->player->getPlayerPos()[1];
        $cell = $this->getMap()[$x][$y];
        if($cell === $this->end){
            if($this->player->lookPokect() === "key"){
                echo "You succes to exist from the lab !!!!\n";
                return $this->setFinish(true);
            }
        }
    }
}
